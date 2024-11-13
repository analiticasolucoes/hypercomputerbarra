<?php

namespace App\Models;

class UserModel {

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $ativo;
    private $perfil;
    private $token;
    private $resetToken;
    private $resetTokenExpires;

    public function __construct($id=0, $nome="", $email="", $senha="", $ativo=true, $perfil="ADMINISTRADOR" , $token="", $resetToken="", $resetTokenExpires="") {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->$email = $email;
        $this->$senha = $senha;
        $this->$ativo = $ativo;
        $this->$perfil = $perfil;
        $this->$token = $token;
        $this->$resetToken = $resetToken;
        $this->$resetTokenExpires = $resetTokenExpires;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setEmail($email) {
        $this->email = strtolower($email);
    }
    
    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function setAtivo($option) {
        $this->ativo = $option;
    }
    
    public function setPerfil($perfil) {
        $this->perfil = strtoupper($perfil);
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setResetToken($resetToken) {
        $this->resetToken = $resetToken;
    }

    public function setResetTokenExpires($resetTokenExpires) {
        $this->resetTokenExpires = $resetTokenExpires;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getAtivo() {
        return $this->ativo;
    }
    
    public function getPerfil() {
        return $this->perfil;
    }

    public function getToken() {
        return $this->token;
    }

    public function getResetToken() {
        return $this->resetToken;
    }

    public function getResetTokenExpires() {
        return $this->resetTokenExpires;
    }
}