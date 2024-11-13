<?php

namespace App\Repositories;

use App\Models\OSModel;
use App\Models\PagamentoModel;
use Exception;

class PagamentoRepository
{
    private $db;

    private OSRepository $osRepository;
    public function __construct($db)
    {
        $this->db = $db;
        $this->osRepository = new OSRepository($db);
    }

    public function incluir(PagamentoModel $pagamento) : bool
    {
        $parametros = [
            'os' => $pagamento->getOs()->getId(),
            'valor' => $pagamento->getValor(),
            'data_pagamento' => $pagamento->getDataPagamento(),
            'metodo_pagamento' => $pagamento->getMetodoPagamento()
        ];
        if ($this->db->inserir("pagamento", $parametros)) {
            $pagamento->setId($this->db->getLastInsertId());
            return true;
        }
        return false;
    }

    public function recuperar(int $id) : ?PagamentoModel
    {
        $query = "SELECT * FROM pagamento WHERE id = :id";

        try {
            $parametros = ['id' => $id];
            $resultado = $this->db->consultar($query, $parametros);

            if (count($resultado) === 1) {
                return $this->generatePagamento($resultado[0]);
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Nenhum pagamento encontrado com o ID fornecido.");
        }
    }

    public function atualizar(PagamentoModel $pagamento) : bool
    {
        try {
            $dados = [
                'os' => $pagamento->getOs(),
                'valor' => $pagamento->getValor(),
                'data_pagamento' => $pagamento->getDataPagamento(),
                'metodo_pagamento' => $pagamento->getMetodoPagamento()
            ];

            $condicao = ["id" => $pagamento->getId()];
            return $this->db->atualizar('pagamento', $dados, $condicao) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar pagamento: " . $e->getMessage());
        }
    }

    public function getPagamentoByOS(OSModel $os) : PagamentoModel
    {
        $query = "SELECT * FROM pagamento WHERE os = :os_id";

        try {
            $parametros = ['os_id' => $os->getId()];
            $resultado = $this->db->consultar($query, $parametros);

            if (count($resultado) === 0) {
                return new PagamentoModel($os);
            }
            return $this->generatePagamento($resultado[0]);
        } catch (Exception $e) {
            throw new Exception("Erro ao pesquisar pagamento por OS.");
        }
    }

    private function generatePagamentoList(array $pagamentoList) : array
    {
        $lista = [];

        foreach ($pagamentoList as $pagamento) {
            $lista[] = $this->generatePagamento($pagamento);
        }

        return $lista;
    }

    public function generatePagamentoListJSon(array $resultado) : void
    {
        header('Content-Type: application/json');
        echo json_encode($this->generatePagamentoList($resultado), JSON_PRETTY_PRINT);
    }

    private function generatePagamento(array $reg) : PagamentoModel
    {
        return new PagamentoModel(
            $this->osRepository->recuperar($reg['os']),
            $reg['valor'],
            $reg['data_pagamento'],
            $reg['metodo_pagamento'],
            $reg['id']
        );
    }
}