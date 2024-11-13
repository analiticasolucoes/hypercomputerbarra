<?php

namespace App\Models;

class PessoaFisicaModel extends ClienteModel
{
    private string $nome;
    private string $cpf;
    private string $dataNascimento;

    public function __construct(
        int $id=0,
        string $email="",
        string $celular="",
        int $preferenciaContato=0,
        string $rua="",
        string $numero="",
        string $bairro="",
        ?string $complemento="",
        string $cidade="",
        string $cep="",
        string $nome="",
        string $cpf="",
        string $dataNascimento=""
    ) {
        parent::__construct(
            $id,
            "PF",
            $email,
            $celular,
            $preferenciaContato,
            $rua,
            $numero,
            $bairro,
            $complemento,
            $cidade,
            $cep
        );
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dataNascimento = $dataNascimento;
    }

    public function jsonSerialize() : mixed {
        return array_merge(parent::jsonSerialize(), get_object_vars($this));
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

    public function setCpf(string $cpf)
    {
        $this->cpf = $cpf;
    }

    public function setDataNascimento(string $dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getDataNascimento(): string
    {
        return $this->dataNascimento;
    }
}