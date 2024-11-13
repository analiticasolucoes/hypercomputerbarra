<?php

namespace App\Core;

use App\Core\Routes;

class Router {
    private $routes = [];

    public function __construct()
    {
        $this->routes = Routes::loadRoutes();
    }

    public function dispatch($requestUri)
    {   
        if($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
            $posicao = strpos($requestUri, "?");
            if ($posicao !== false) {
                $requestUri = substr($requestUri, 0, $posicao);
            }
        }
        foreach ($this->routes as $route => $routeInfo) {
            // Verifica se a rota atual corresponde à requisição
            if ($route === $requestUri) {
                // Retorna a ação do controlador correspondente
                return $routeInfo;
            }
        }

        return null;
    }
    
    public function getController($action) {
        if (array_key_exists($action, $this->routes)) {
            return $this->routes[$action]['controller'];
        }
        return null;
    }

    public function getAction($action) {
        if (array_key_exists($action, $this->routes)) {
            return $this->routes[$action]['action'];
        }
        return null;
    }
}