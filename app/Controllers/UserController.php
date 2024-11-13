<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\ViewController;
use App\Repositories\UserRepository;
use App\Services\Session;
use App\Services\Pagination;

class UserController {
    private UserModel $userModel;
    private UserRepository $userRepository;

    public function __construct($conn) {
        $this->userModel = new UserModel();
        $this->userRepository = new UserRepository($conn);
    }

    public function index() {
        include '../app/Views/user/add.php';
    }

    public function inactive() {
        ViewController::render(
            "error",
            "Acesso Suspenso - Usuário",
            "Não foi possível liberar seu acesso ao sistema no momento!",
            "/",
            "Sair",
            ["error" => "Acesso suspenso, favor entrar em contrato com o administrador do sistema."]
        );
        return;
    }

    public function addHandler($user) {
        $nome = $user['nome'];
        $email = $user['email'];
        $perfil = $user['perfil'];

        $this->userModel->setNome($nome);
        $this->userModel->setEmail($email);
        $this->userModel->setAtivo(true);
        $this->userModel->setPerfil($perfil);
        $this->userModel->setSenha('');

        $resultado = $this->userRepository->incluir($this->userModel);

        if($resultado) {
            ViewController::render(
                "sucess",
                "Cadastramento - Usuário",
                "Usuário cadastrado com sucesso!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Cadastramento - Usuário",
                "Não foi possível cadastrar o usuário...!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                ["error" => ""]
            );
        }
    }

    public function list() {
        isset($search['page']) ? $page = $search['page'] : $page = 1;
        $userList = $this->userRepository->getAllUsers();

        $action = "result";
        $qtdResultados = count($userList);
        $pagination = new Pagination("user/list", count($userList), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($userList);
        $navigation = $pagination->getNavigation("", "");
        include("../app/Views/user/list.php");
    }

    public function edit($user) {
        $userToEdit = $this->userRepository->recuperar($user['id']);

        include("../app/Views/user/edit.php");
    }

    public function editHandler($user) {
        $userToUpdate = $this->userRepository->recuperar($user['id']);
        
        $userToUpdate->setNome($user['nome']);
        $userToUpdate->setPerfil($user['perfil']);
        $userToUpdate->setAtivo(isset($user['ativo']));

        $resultado = $this->userRepository->atualizar($userToUpdate);

        if($resultado) {
            ViewController::render(
                "sucess",
                "Alteração - Usuário",
                "Usuário alterado com sucesso!",
                "/user/list",
                "Voltar",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Alteração - Usuário",
                "Não foi possível alterar o usuário...!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                ["error" => ""]
            );
        }
    }

    public function getUserByNome($nome) {
        $user = $this->userRepository->getUserByNome($nome['nome']);
        if($user)
            echo true;
        else 
            echo false;
    }

    public function getUserByEmail($email) {
        $user = $this->userRepository->getUserByEmail($email['email']);
        if($user)
            echo true;
        else 
            echo false;
    }

    public function validUserByEmail($email) {
        $user = $this->userRepository->getUserByEmail($email);
        if($user)
            return true;
        else 
            return false;
    }

    public function changePassword() {
        include '../app/Views/user/change_password.php';
    }
    
    public function changePasswordHandler($form) {
        $userId = Session::get('user_id') ?? null;
        $user = $this->userRepository->recuperar($userId);

        $currentPassword = $form['current_password'] ?? '';
        $newPassword = $form['new_password'] ?? '';
        $confirmPassword = $form['confirm_password'] ?? '';
    
        // Verifique se as senhas nova e confirmada são iguais
        if ($newPassword !== $confirmPassword) {
            ViewController::render(
                "error",
                "Alteração - Senha",
                "Não foi possível alterar a senha...",
                "/user/change_password",
                "Voltar",
                ["error" => "As senhas nova e confirmada não são iguais."]
            );
            return;
        }
    
        // Verifique se a senha atual é válida
        $isValid = $this->userRepository->checkPassword($user, $currentPassword);
        if (!$isValid) {
            ViewController::render(
                "error",
                "Alteração - Senha",
                "Não foi possível alterar a senha...",
                "/user/change_password",
                "Voltar",
                ["error" => "Senha atual incorreta."]
            );
            return;
        }

        $resultado = $this->userRepository->updatePassword($user, $newPassword);
        
        if($resultado) {
            ViewController::render(
                "sucess",
                "Alteração - Senha",
                "Senha alterada com sucesso!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Alteração - Senha",
                "Não foi possível alterar a senha...!",
                "/user/change_password",
                "Voltar",
                ["error" => "Erro ao atualizar registro do usuário no sistema."]
            );
        }
    }

    public function changeEmail() {
        $userId = Session::get('user_id') ?? null;
        $user = $this->userRepository->recuperar($userId);
        $currentEmail = $user->getEmail();
        include '../app/Views/user/change_email.php';
    }
    
    public function changeEmailHandler($form) {
        $userId = Session::get('user_id') ?? null;
        $user = $this->userRepository->recuperar($userId);
    
        $newEmail = $form['new_email'] ?? '';
        $confirmEmail = $form['confirm_email'] ?? '';
        
        // Verifique se os emails novo e confirmado são iguais
        if ($newEmail !== $confirmEmail) {
            ViewController::render(
                "error",
                "Alteração - E-mail",
                "Não foi possível alterar o e-mail cadastrado...",
                "/user/change_email",
                "Voltar",
                ["error" => "Os e-mails novo e confirmado não são iguais!"]
            );
            return;
        }

        //Verifica se ja existe um usuario com o novo e-mail informado
        if($this->validUserByEmail($newEmail)) {
            ViewController::render(
                "error",
                "Alteração - E-mail",
                "Não foi possível alterar o e-mail cadastrado...",
                "/user/change_email",
                "Voltar",
                ["error" => "O novo e-mail informado já está em uso por outro usuário! Informe um novo e-mail diferente."]
            );
            return;
        }

        // Altere o e-mail
        $resultado = $this->userRepository->updateEmail($user, $newEmail);
        
        if($resultado) {
            ViewController::render(
                "sucess",
                "Alteração - E-mail",
                "E-mail alterado com sucesso!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Alteração - E-mail",
                "Não foi possível alterar o e-mail cadastrado...!",
                "/user/change_email",
                "Voltar",
                ["error" => ""]
            );
        }
    }
}