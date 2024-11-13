<?php

namespace App\Models;

use App\Models\EstadoModel;
use JsonSerializable;

class CidadeModel implements JsonSerializable
{
    private $id;
    private EstadoModel $estado;
    private $nome;

    public function __construct($id=0, EstadoModel $estado=null, $nome="") {
        $this->id = $id;
        $this->estado = $estado ?? new EstadoModel();
        $this->nome = $nome;
    }

    public function jsonSerialize() : mixed {
        return get_object_vars($this);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEstado(EstadoModel $estado) {
        $this->estado = $estado;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getNome() {
        return $this->nome;
    }
}