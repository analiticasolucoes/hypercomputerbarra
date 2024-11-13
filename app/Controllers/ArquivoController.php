<?php

namespace App\Controllers;

class ArquivoController {

    public function download($filePath) : void
    {
        $path = dirname(__DIR__) . $filePath['path'];

        // Verifica se o arquivo existe
        if (!file_exists($path)) {
            include '../app/Views/404.php';
            exit;
        }

        // Força o download do arquivo
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($path));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }

    public static function delete($dir) : bool
    {
        $path = dirname(__DIR__) . $dir;

        // Verifica se o caminho existe
        if (!file_exists($path)) {
            return false;
        }

        // Se for um arquivo, usa unlink() para deletar
        if (is_file($path)) {
            if(!@unlink($path)) echo "Erro ao tentar apagar o arquivo informado: {$path}!";
            return @unlink($path);
        }

        // Se for um diretório
        if (is_dir($path)) {
            self::clean($dir);
            return rmdir($path);
        }
        echo "O caminho informado não é um diretório nem um arquivo que possa ser excluido!";
        return false;
    }

    public static function clean($dir): bool
    {
        $path = dirname(__DIR__) . $dir;

        // Verifica se o caminho existe
        if (!file_exists($path)) {
            return false;
        }

        // Se for um arquivo, usa unlink() para deletar
        if (is_file($path)) {
            if(!@unlink($path)) echo "Erro ao tentar apagar o arquivo informado: {$path}!";
            return @unlink($path);
        }

        // Se for um diretório
        if (is_dir($path)) {
            // Escaneia o conteúdo do diretório
            $items = scandir($path);
            // Remove '.' e '..'
            $items = array_diff($items, array('.', '..'));

            // Itera sobre o conteúdo do diretório
            foreach ($items as $item) {
                // Chama recursivamente a função destroy para cada item
                self::clean($dir . DIRECTORY_SEPARATOR . $item);
            }
            return true;
        }
        echo "O caminho informado não é um diretório nem um arquivo que possa ser excluido!";
        return false;
    }
}