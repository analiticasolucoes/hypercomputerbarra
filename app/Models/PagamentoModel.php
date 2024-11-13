<?php

namespace App\Models;

class PagamentoModel
{
    private ?int $id;
    private OSModel $os;
    private ?float $valor;
    private ?string $dataPagamento;
    private ?string $metodoPagamento;

    public function __construct(OSModel $os, ?float $valor = 0.0, ?string $dataPagamento = "", ?string $metodoPagamento = "", ?int $id = null)
    {
        $this->id = $id;
        $this->os = $os;
        $this->valor = $valor;
        $this->dataPagamento = $dataPagamento;
        $this->metodoPagamento = $metodoPagamento;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getOs(): OSModel
    {
        return $this->os;
    }

    public function setOs(OSModel $os): void
    {
        $this->os = $os;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getDataPagamento(): string
    {
        return $this->dataPagamento;
    }

    public function setDataPagamento(string $dataPagamento): void
    {
        $this->dataPagamento = $dataPagamento;
    }

    public function getMetodoPagamento(): string
    {
        return $this->metodoPagamento;
    }

    public function setMetodoPagamento(string $metodoPagamento): void
    {
        $this->metodoPagamento = $metodoPagamento;
    }
}
