<?php

namespace App\Services;

use DateTime;
use Exception;

class DateHandler
{
    private function formatarData($dataOriginal, $formato): string
    {
        // Determinar o formato de entrada da data original
        if (strpos($dataOriginal, '/') !== false) {
            // Formato de entrada é "d/m/Y H:i"
            list($data, $hora) = explode(' ', $dataOriginal);
            list($dia, $mes, $ano) = explode('/', $data);
            list($hora, $minuto) = explode(':', $hora);
            $minuto = str_pad($minuto, 2, '0', STR_PAD_LEFT);

            if ($formato == 'd/m/Y H:i') {
                // Formatar para "d/m/Y H:i"
                return "$dia/$mes/$ano $hora:$minuto";
            } elseif ($formato == 'Y-m-d H:i:s') {
                // Formatar para "Y-m-d H:i:s"
                return "$ano-$mes-$dia $hora:$minuto:00";
            } else {
                throw new Exception("Formato de saída inválido: $formato");
            }
        } elseif (strpos($dataOriginal, '-') !== false) {
            // Formato de entrada é "Y-m-d H:i:s"
            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dataOriginal);

            if ($dateTime === false) {
                throw new Exception("Data de entrada inválida: $dataOriginal");
            }

            if ($formato == 'd/m/Y H:i') {
                // Formatar para "d/m/Y H:i"
                return $dateTime->format('d/m/Y H:i');
            } elseif ($formato == 'Y-m-d H:i:s') {
                // Formatar para "Y-m-d H:i:s"
                return $dateTime->format('Y-m-d H:i:s');
            } else {
                throw new Exception("Formato de saída inválido: $formato");
            }
        } else {
            throw new Exception("Formato de entrada desconhecido para a data: $dataOriginal");
        }
    }

    private function validarData($dataOriginal, $formatoEntrada): bool
    {
        $dateTime = DateTime::createFromFormat($formatoEntrada, $dataOriginal);
        if ($dateTime === false) {
            $errors = DateTime::getLastErrors();
            if ($errors['error_count'] > 0) {
                echo "Erros encontrados:\n";
                foreach ($errors['errors'] as $error) {
                    echo $error . "\n";
                }
            }
            if ($errors['warning_count'] > 0) {
                echo "Avisos encontrados:\n";
                foreach ($errors['warnings'] as $warning) {
                    echo $warning . "\n";
                }
            }
            return false;
        }
        return true;
    }

    public static function converterData(string $data, string $formatoEntrada, string $formatoSaida = "Y-m-d H:i:s"): string
    {
        $instance = new self(); // Criar uma instância para chamar o método não estático
        
        $data = $instance->formatarData($data, $formatoEntrada);

        $validacaoEntrada = $instance->validarData($data, $formatoEntrada);

        if ($validacaoEntrada) {
            // Criar um objeto DateTime a partir da string de data original
            $dateTime = DateTime::createFromFormat($formatoEntrada, $data);

            // Verificar se a conversão foi bem-sucedida
            if ($dateTime === false) {
                // Obter os erros da última tentativa de criação do DateTime
                $errors = DateTime::getLastErrors();

                // Exibir os erros
                if ($errors['error_count'] > 0) {
                    echo "Erros encontrados:\n";
                    foreach ($errors['errors'] as $error) {
                        echo $error . "\n";
                    }
                }

                // Exibir os avisos
                if ($errors['warning_count'] > 0) {
                    echo "Avisos encontrados:\n";
                    foreach ($errors['warnings'] as $warning) {
                        echo $warning . "\n";
                    }
                }

                throw new Exception("Falha na conversão da data.");
            } else {
                // Converter para o formato de saída desejado
                return $dateTime->format($formatoSaida);
            }
        } else {
            throw new Exception("Erro de validação, data informada incompatível com o formato de entrada!");
        }
    }
}