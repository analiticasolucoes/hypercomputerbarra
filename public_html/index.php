<?php
// Exibe todos os tipos de erros
error_reporting(E_ALL);

// Ativa a exibição dos erros no navegador
ini_set('display_errors', 1);

require '../autoload.php';
require '../config/load_env.php';
require '../config/db_connect.php';

use App\Core\Router;
use App\Controllers\LoginController;
use App\Services\Session;

// Carrega as variáveis de ambiente
loadEnv(__DIR__ . '/../.env');

// Conecta ao banco de dados
$conn = dbConnect(); // Conecta ao banco de dados e retorna o objeto Database

Session::start();

$router = new Router();

$requestUri = $_SERVER['REQUEST_URI'];
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $pos = strpos($_SERVER['REQUEST_URI'], '?');
    
    if ($pos !== false) {
        $requestUri = substr($_SERVER['REQUEST_URI'], 0, $pos);
    }
}

// Verificar a rota e chamar o controlador apropriado
$routeInfo = $router->dispatch($requestUri);

if (is_array($routeInfo) && isset($routeInfo['controller']) && isset($routeInfo['method'])) {
    $classControllerPath = '../app/Controllers/' . $routeInfo['controller'] . '.php';
    $classController = "App\\Controllers\\" . $routeInfo['controller'];
    $methodName = $routeInfo['method'];
    $isPublic = isset($routeInfo['public']) ? $routeInfo['public'] : false;

    // Se a rota não for pública, verificar se o usuário está autorizado
    if (!$isPublic) {
        $loginController = new LoginController($conn);
        if (!$loginController->authorize()) {
            // Usuário não está autorizado, redirecionar para a página de login
            header('Location: /');
            exit;
        }
        $loginController = null;
    }

    // Verificar se a classe do controlador existe
    if (file_exists($classControllerPath)) {
        include_once $classControllerPath;
        $controller = new $classController($conn);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->$methodName($_POST);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (!empty($_GET)) {
                $controller->$methodName($_GET);
            } else {
                $controller->$methodName();
            }
        }
    }
} else {
    // Se a rota não for encontrada ou não for válida, exibir uma página de erro 404
    include '../app/Views/404.php';
}