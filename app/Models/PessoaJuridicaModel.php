<?php

namespace App\Models;

class PessoaJuridicaModel extends ClienteModel
{
    protected string $razaoSocial;
    protected string $cnpj;
    protected ?string $inscricaoEstadual;

    public function __construct(
        int $id,
        string $email,
        string $celular,
        int $preferenciaContato,
        string $rua,
        string $numero,
        ?string $complemento,
        string $cidade,
        string $cep,
        string $razaoSocial,
        string $cnpj,
        ?string $inscricaoEstadual
    ) {
        parent::__construct(
            $id,
            'PJ',
            $email,
            $celular,
            $preferenciaContato,
            $rua,
            $numero,
            $complemento,
            $cidade,
            $cep
        );
        $this->razaoSocial = $razaoSocial;
        $this->cnpj = $cnpj;
        $this->inscricaoEstadual = $inscricaoEstadual;
    }

    public function jsonSerialize() : mixed {
        return array_merge(parent::jsonSerialize(), get_object_vars($this));
    }

    public function setRazaoSocial(string $razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
    }

    public function setCNPJ(string $cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function setInscricaoEstadual(?string $inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual;
    }

    public function getRazaoSocial(): string
    {
        return $this->razaoSocial;
    }

    public function getCNPJ(): string
    {
        return $this->cnpj;
    }

    public function getInscricaoEstadual(): ?string
    {
        return $this->inscricaoEstadual;
    }
}
?>
