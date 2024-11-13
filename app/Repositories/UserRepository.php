<?php

namespace App\Repositories;

use App\Models\UserModel;
use Exception;

class UserRepository 
{
    private $db;
    private UserModel $user;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUser() : UserModel {
        return $this->user;
    }

    public function incluir($user) : bool {
        $parametros = [
            'nome' => $user->getNome(),
            'email' => $user->getEmail(),
            'senha' => password_hash($user->getSenha(), PASSWORD_DEFAULT),
            'ativo' => $user->getAtivo() ? true : false,
            'perfil' => $user->getPerfil(),
            'token' => bin2hex(random_bytes(32))
        ];

        if($this->db->inserir("usuario", $parametros)) {
            $user->setId($this->db->getLastInsertId());
            $this->user = $user;
            return true;
        }
        return false;
    }

    public function recuperar($id) : UserModel {
        $query = "SELECT * FROM usuario WHERE id = :id";
        
        try {
            $parametros = ['id' => $id];
            $resultado = $this->db->consultar($query, $parametros);
    
            if (count($resultado) == 1) {
                return $this->generateUser($resultado[0]);
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw new Exception("Nenhum usuário encontrado com o ID fornecido.");
        }
    }

    public function atualizar(UserModel $user) : bool {
        try {
            $dados = [
                'nome' => $user->getNome(),
                'email' => $user->getEmail(),
                'senha' => $user->getSenha(),
                'ativo' => $user->getAtivo(),
                'perfil' => $user->getPerfil(),
                'token' => bin2hex(random_bytes(32))
            ];

            $condicao = [
                "id" => $user->getId()
            ];
            return $this->db->atualizar('usuario', $dados, $condicao) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }

    public function excluir(UserModel $user) : bool {
        try {
            $condicao = "id = :id";
            $parametros = ['id' => $user->getId()];
            return $this->db->excluir('usuario', $condicao, $parametros) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir usuário: " . $e->getMessage());
        }
    }

    public function updateToken($user, $token) {
        $dados = [
            'token' => $token
        ];

        $condicao = [
            'id' => $user->getId()
        ];

        if($this->db->atualizar('usuario', $dados, $condicao)) {
            $user->setToken($token);
            return true;
        } else {
            return false;
        }
    }

    public function updateResetToken($user) {
        $resetToken = bin2hex(random_bytes(32));
        $dados = [
            'reset_token' => $resetToken,
            'reset_token_expires' => date('Y-m-d H:i:s', strtotime('+2 hours'))
        ];

        $condicao = [
            "id" => $user->getId()
        ];

        if($this->db->atualizar('usuario', $dados, $condicao)) {
            $user->setResetToken($resetToken);
            $this->user = $user;
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword($user, $newPassword) {
        $dados = [
            'senha' => password_hash($newPassword, PASSWORD_DEFAULT)
        ];

        $condicao = [
            "id" => $user->getId()
        ];

        return $this->db->atualizar('usuario', $dados, $condicao) ? true : false;
    }

    public function checkPassword($user, $password) {
        return password_verify($password, $user->getSenha());
    }

    public function updateEmail($user, $newEmail) {
        $dados = [
            'email' => strtolower($newEmail)
        ];

        $condicao = [
            "id" => $user->getId()
        ];

        return $this->db->atualizar('usuario', $dados, $condicao) ? true : false;
    }

    public function checkEmail($user, $password) {
        return strcasecmp($password, $user->getSenha()) ? false : true; 
    }

    public function getUserByNome($nome) {
        $query = "SELECT * FROM usuario WHERE nome = :nome";
        $parametros = ['nome' => $nome];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) == 1) {
            return $this->generateUser($resultado[0]);
        } else {
            return null;
        }
    }

    public function getUsernameById($userId) {
        $sql = "SELECT name FROM usuario WHERE id = :userId";
        $params = [':userId' => $userId];
        
        $result = $this->db->consultar($sql, $params);
        
        if ($result) {
            return $result['name'];
        } else {
            return null;
        }
    }

    public function isAdmin($username) {
        $sql = 
        "SELECT 
            is_admin
        FROM
            usuarios
        WHERE
            nome = :username";
        return $this->db->consultar($sql, ['username' => $username]);
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM usuario WHERE email = :email LIMIT 1";
        $parametros = ['email' => $email];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) == 1) {
            return $this->generateUser($resultado[0]);
        } else {
            return null;
        }
    }

    public function getAllUsers() : array {
        $sql = "SELECT * FROM usuario";
        $result = $this->db->consultar($sql, []);
        if (count($result) > 0) {
            return $this->generateUsersList($result);
        } else {
            return [];
        }
    }

    public function getUserByResetToken($resetToken) {
        $sql = "SELECT * FROM usuario WHERE reset_token = :resetToken AND reset_token_expires > NOW()";
        $resultado = $this->db->consultar($sql, ['resetToken' => $resetToken]);
        
        if (count($resultado) == 1) {
            return $this->generateUser($resultado[0]);
        } else {
            return null;
        }
    }

    public function getTotalUsersCount() {
        $sql = "SELECT COUNT(*) as count FROM usuario";
        $result = $this->db->consultar($sql);
        return $result['count'];
    }

    private function generateUsersList ($userList) {
        $users = [];
        foreach($userList as $user){
            $users[] = $this->generateUser($user);
        }
        return $users;
    }
    
    private function generateUser($userReg) {
        $user = new UserModel();
        
        $user->setId($userReg['id']);
        $user->setNome($userReg['nome']);
        $user->setEmail($userReg['email']);
        $user->setSenha($userReg['senha']);
        $user->setAtivo($userReg['ativo']);
        $user->setPerfil($userReg['perfil']);
        $user->setToken($userReg['token']);
        $user->setResetToken($userReg['reset_token']);
        $user->setResetTokenExpires($userReg['reset_token_expires']);
        
        return $user;
    }
}