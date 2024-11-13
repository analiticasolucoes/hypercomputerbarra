<?php

namespace App\Models;

use App\Models\ClienteModel;

class OSModel
{
    private int $id;
    private string $tipo;
    private ?OSModel $osAnterior;
    private ?ClienteModel $cliente;
    private string $equipamento;
    private string $marca;
    private string $modelo;
    private string $serie;
    private ?string $senha;
    private string $acessorio;
    private ?string $diagnostico;
    private ?string $solucao;
    private ?string $observacao;
    private string $estagio;
    private ?string $dataGarantia;
    private ?float $valorServico;
    private ?float $valorPeca;
    private ?string $pecasSubstituidas;
    private string $createdAt;
    private string $createdBy;
    private ?string $updatedAt;
    private ?string $updatedBy;

    public function __construct(
        $id = 0,
        $tipo = "",
        $osAnterior = null,
        $cliente = null,
        $equipamento = "",
        $marca = "",
        $modelo = "",
        $serie = "",
        $senha = "",
        $acessorio = "",
        $diagnostico = "",
        $solucao = "",
        $observacao = "",
        $estagio = "",
        $dataGarantia = "",
        $valorServico = 0.0,
        $valorPeca = 0.0,
        $pecasSubstituidas = "",
        $createdAt = "",
        $createdBy = "",
        $updatedAt = "",
        $updatedBy = ""
    ) {
        $this->id = $id;
        $this->tipo = $tipo;
        $this->osAnterior = $osAnterior;
        $this->cliente = $cliente;
        $this->equipamento = $equipamento;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->serie = $serie;
        $this->senha = $senha;
        $this->acessorio = $acessorio;
        $this->diagnostico = $diagnostico;
        $this->solucao = $solucao;
        $this->observacao = $observacao;
        $this->estagio = $estagio;
        $this->dataGarantia = $dataGarantia;
        $this->valorServico = $valorServico;
        $this->valorPeca = $valorPeca;
        $this->pecasSubstituidas = $pecasSubstituidas;
        $this->createdAt = $createdAt;
        $this->createdBy = $createdBy;
        $this->updatedAt = $updatedAt;
        $this->updatedBy = $updatedBy;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;
    }

    public function setOsAnterior(?OSModel $osAnterior)
    {
        $this->osAnterior = $osAnterior;
    }

    public function setCliente(ClienteModel $cliente)
    {
        $this->cliente = $cliente;
    }

    public function setEquipamento(string $equipamento)
    {
        $this->equipamento = $equipamento;
    }

    public function setMarca(string $marca)
    {
        $this->marca = $marca;
    }

    public function setModelo(string $modelo)
    {
        $this->modelo = $modelo;
    }

    public function setSerie(string $serie)
    {
        $this->serie = $serie;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
    }

    public function setAcessorio(string $acessorio)
    {
        $this->acessorio = $acessorio;
    }

    public function setDiagnostico(string $diagnostico)
    {
        $this->diagnostico = $diagnostico;
    }

    public function setSolucao(string $solucao)
    {
        $this->solucao = $solucao;
    }

    public function setObservacao(string $observacao)
    {
        $this->observacao = $observacao;
    }

    public function setEstagio(string $estagio)
    {
        $this->estagio = $estagio;
    }

    public function setDataGarantia(string $dataGarantia)
    {
        $this->dataGarantia = $dataGarantia;
    }

    public function setValorServico(float $valorServico)
    {
        $this->valorServico = $valorServico;
    }

    public function setValorPeca(float $valorPeca)
    {
        $this->valorPeca = $valorPeca;
    }

    public function setPecasSubstituidas(string $pecasSubstituidas)
    {
        $this->pecasSubstituidas = $pecasSubstituidas;
    }
    public function setCreatedAt(string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setCreatedBy(string $createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    
    public function setUpdatedBy(string $updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getTipo() : string
    {
        return $this->tipo;
    }

    public function getOsAnterior() : ?OSModel
    {
        return $this->osAnterior;
    }

    public function getCliente() : ClienteModel
    {
        return $this->cliente;
    }

    public function getEquipamento() : string
    {
        return $this->equipamento;
    }

    public function getMarca() : string
    {
        return $this->marca;
    }

    public function getModelo() : string
    {
        return $this->modelo;
    }

    public function getSerie() : string
    {
        return $this->serie;
    }

    public function getSenha() : string
    {
        return $this->senha;
    }

    public function getAcessorio() : string
    {
        return $this->acessorio;
    }

    public function getDiagnostico() : string
    {
        return $this->diagnostico;
    }

    public function getSolucao() : string
    {
        return $this->solucao;
    }

    public function getObservacao() : string
    {
        return $this->observacao;
    }

    public function getEstagio() : string
    {
        return $this->estagio;
    }

    public function getDataGarantia() : string
    {
        return $this->dataGarantia;
    }

    public function getValorServico() : float
    {
        return $this->valorServico;
    }

    public function getValorPeca() : float
    {
        return $this->valorPeca;
    }

    public function getPecasSubstituidas() : string
    {
        return $this->pecasSubstituidas;
    }
    public function getCreatedAt() : string
    {
        return $this->createdAt;
    }

    public function getCreatedBy() : string
    {
        return $this->createdBy;
    }

    public function getUpdatedAt() : string
    {
        return $this->updatedAt;
    }
    
    public function getUpdatedBy() : string
    {
        return $this->updatedBy;
    }
}