<?php

class ArquivoModel {
    private $id;
    private $topico_id;
    private $nome;
    private $caminho;
    private $tipo;
    private $tamanho;
    
    public function __construct($id=0, $topicoId=0, $nome="", $caminho="", $tipo="", $tamanho=0) {
        $this->id = $id;
        $this->topico_id = $topicoId;
        $this->nome = $nome;
        $this->caminho = $caminho;
        $this->tipo = $tipo;
        $this->tamanho = $tamanho;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setTopicoId($topico_id) {
        $this->topico_id = $topico_id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCaminho($caminho) {
        $this->caminho = $caminho;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    public function getId() {
        return $this->id;
    }

    public function getTopicoId() {
        return $this->topico_id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCaminho() {
        return $this->caminho;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getTamanho() {
        return $this->tamanho;
    }
}
?>
