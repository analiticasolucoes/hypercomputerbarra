<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Models\UserModel;
use App\Services\Session;
use App\Services\Email;
use Exception;

class LoginController {
    private UserRepository $userRepository;

    public function __construct($conn) {
        $this->userRepository = new UserRepository($conn);
    }

    public function index() {
        include "../app/Views/login.php";
    }

    public function login($form) {
        $email = $form['email'];
        $password = $form['senha'];
        
        $user = $this->userRepository->getUserByEmail($email);
        
        if ($user && password_verify($password, $user->getSenha())) {
            
            Session::set("username", $user->getNome());
            Session::set("user_id", $user->getId());
            Session::set("perfil", $user->getPerfil());

            $token = bin2hex(random_bytes(32));

            $this->userRepository->updateToken($user, $token);

            Session::set("token", $user->getToken());

            if($user->getAtivo())
                header("Location: /user/dashboard");
            else
                header("Location: /user/inactive");
        } else {
            header("Location: /");
        }
    }
    
    public function authorize() : bool {
        // Verificar se o usuário está logado
        if (!Session::get('user_id') || !Session::get('token')) {
            // Redirecionar para a página de login se o usuário não estiver logado
            return false;
        }
        
        $user = $this->userRepository->recuperar(Session::get('user_id'));

        if (Session::get('token') !== $user->getToken()) {
            return false;
        }
        
        return true;
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /');
        exit;
    }
    
    public function forgotPasswordHandler($params) {
        $email = $params['email'];
        $user = $this->userRepository->getUserByEmail($email);        

        if ($user) {
            $this->userRepository->updateResetToken($user);
            
            $token = $this->userRepository->getUser()->getResetToken();
            
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";

            // Obtém o nome do host
            $host = $_SERVER['HTTP_HOST'];

            // Endereço base do site
            $base_url = $protocol . $host;

            $resetLink = $base_url."/reset_password?token=$token";

            $email = new Email();

            $email->loadTemplateMessage(
                "../app/Views/templates/reset-password-email.html",
                [
                    "user_nome" => $user->getNome(),
                    "reset_link" => $resetLink,
                ]);
            $email->sendEmail(
                $user->getEmail(),
                "Redefinir Senha - HyperComputer - Sistema de Controle de OS"
            );
        }
        include "../app/Views/sucess_forgot_password.php";
    }

    public function forgotPassword() {
        include '../app/Views/forgot_password.php';
    }
    
    public function resetPasswordHandler($params) {
        $token = $params['token'];
        $newPassword = $params['new_password'];
        $confirmPassword = $params['confirm_password'];
    
        $user = $this->userRepository->getUserByResetToken($token);
        
        if ($user && !strcmp($newPassword, $confirmPassword)) {
            if($this->userRepository->updatePassword($user, $newPassword)) {
                include "../app/Views/sucess_reset_password.php";
            }
            else {
                echo "<h1>Falha ao redefinir a senha. Por favor, entre em contato com o suporte do sistema!</h1>";
            }
        }
    }
    
    public function resetPassword($form) {
        $user = $this->userRepository->getUserByResetToken($form['token']);
        if ($user) {
            Session::set('resetToken', $form['token']);
            include '../app/Views/reset_password.php';
        } else {
            echo "Falha ao redefinir a senha. Por favor, tente novamente.";
        }
    }
}