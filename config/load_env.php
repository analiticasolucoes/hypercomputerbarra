<?php

function loadEnv($filePath) {
    // Verifica se o arquivo .env existe
    if (file_exists($filePath)) {
        // Lê o arquivo .env
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Ignora linhas que não são variáveis válidas
            if (strpos($line, '=') !== false && strpos($line, '#') === false) {
                list($key, $value) = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);

                // Define a variável de ambiente
                putenv("$key=$value");
            }
        }
    }
}