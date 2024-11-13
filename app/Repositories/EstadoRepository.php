<?php

namespace App\Repositories;

use App\Models\EstadoModel;
use Exception;

class EstadoRepository {

    private $db;
    private EstadoModel $estado;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getEstado() : EstadoModel {
        return $this->estado;
    }

    public function incluir(EstadoModel $estado) : bool {
        $parametros = [
            'id' => $estado->getId(),
            'sigla' => $estado->getSigla(),
            'nome' => $estado->getNome(),
        ];

        if($this->db->inserir("estado", $parametros)) {
            $estado->setId($this->db->getLastInsertId());
            $this->estado = $estado;
            return true;
        }
        return false;
    }

    public function recuperar($id) : EstadoModel {
        $query = "SELECT * FROM estado WHERE id = :id";
        $parametros = ['id' => $id];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) > 0) {
            $registro = $resultado[0];
            $estado = new EstadoModel($this->db);
            $estado->setId($registro['id']);
            $estado->setSigla($registro['sigla']);
            $estado->setNome($registro['nome']);
            return $estado;
        } else {
            return null;
        }
    }

    public function atualizar(EstadoModel $estado) : bool {
        try {
            $dados = [
                'id' => $estado->getId(),
                'sigla' => $estado->getSigla(),
                'nome' => $estado->getNome()
            ];
            $condicao = "id = " . $estado->getId();
            return $this->db->atualizar('estado', $dados, $condicao) ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function excluir(EstadoModel $estado) : bool {
        try {
            $condicao = "id = :id";
            $parametros = ['id' => $estado->getId()];
            return $this->db->excluir('topicos', $condicao, $parametros) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir tópico: " . $e->getMessage());
        }
    }

    public function getAllEstados() {
        $query = "SELECT * FROM estado";
        $resultado = $this->db->consultar($query);
        
        return ($this->generateEstadoList($resultado));
    }

    private function generateEstadoList ($estadoList) {
        foreach($estadoList as $estado){
            $estadoModel = new EstadoModel($this->db);
            $estadoModel->setId($estado['id']);
            $estadoModel->setSigla($estado['sigla']);
            $estadoModel->setNome($estado['nome']);
            $estados[] = $estadoModel;
        }
        return $estados;
    }
}
?>