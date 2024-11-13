<?php

namespace App\Models;
use JsonSerializable;

class ClienteModel implements JsonSerializable
{
    private int $id;
    private string $tipo;
    private string $email;
    private string $celular;
    private int $preferenciaContato;
    private string $rua;
    private string $numero;
    private string $bairro;
    private ?string $complemento;
    private string $cidade;
    private string $cep;

    public function __construct(
        int $id=0,
        string $tipo="",
        string $email="",
        string $celular="",
        int $preferenciaContato=0,
        string $rua="",
        string $numero="",
        string $bairro="",
        ?string $complemento="",
        string $cidade="",
        string $cep=""
    ) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->email = $email;
        $this->celular = $celular;
        $this->preferenciaContato = $preferenciaContato;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->complemento = $complemento;
        $this->cidade = $cidade;
        $this->cep = $cep;
    }

    public function jsonSerialize() : mixed {
        return get_object_vars($this);
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTipo($tipo)
    {
        $this->tipo;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setCelular($celular)
    {
         $this->celular = $celular;
    }

    public function setPreferenciaContato($preferenciaContato)
    {
        $this->preferenciaContato = $preferenciaContato;
    }

    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCelular(): string
    {
        return $this->celular;
    }

    public function getPreferenciaContato(): int
    {
        return $this->preferenciaContato;
    }

    public function getRua(): string
    {
        return $this->rua;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getCep(): string
    {
        return $this->cep;
    }
}