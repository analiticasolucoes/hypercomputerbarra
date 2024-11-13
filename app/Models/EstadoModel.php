<?php

namespace App\Models;
use JsonSerializable;

class EstadoModel implements JsonSerializable{

    private $id;
    private $sigla;
    private $nome;

    public function __construct($id=0, $sigla="", $nome="") {
        $this->id = $id;
        $this->sigla = $sigla;
        $this->nome = $nome;
    }

    public function jsonSerialize() : mixed {
        return get_object_vars($this);
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setSigla($sigla) {
        $this->sigla = $sigla;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getSigla() {
        return $this->sigla;
    }

    public function getNome() {
        return $this->nome;
    }
}