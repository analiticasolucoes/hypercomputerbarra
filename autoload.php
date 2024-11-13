<?php

spl_autoload_register(function ($class) {
    // Remove o prefixo "App\" do nome da classe, se presente
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';
    
    // Verifica se a classe usa o prefixo "App\"
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        // Não, passa para o próximo autoloader registrado
        return;
    }
    
    // Obtém o nome relativo da classe
    $relativeClass = substr($class, strlen($prefix));
    
    // Substitui os separadores de namespace por separadores de diretório
    // Adiciona o diretório base, e sufixa com .php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    
    // Verifica se o arquivo existe e inclui o arquivo
    if (file_exists($file)) {
        require $file;
    } else {
        die("Arquivo não encontrado: " . $file);
    }
});