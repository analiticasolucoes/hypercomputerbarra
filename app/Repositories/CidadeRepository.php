<?php

namespace App\Repositories;

use App\Models\CidadeModel;
use App\Models\EstadoModel;
use App\Repositories\EstadoRepository;

class CidadeRepository {

    private $db;
    private CidadeModel $cidade;
    private EstadoRepository $estadoRepository;

    public function __construct($db)
    {
        $this->db = $db;
        $this->cidade = new CidadeModel();
        $this->estadoRepository = new EstadoRepository($db);
    }

    public function getCidade() : CidadeModel {
        return $this->cidade;
    }

    public function recuperar($id) {
        $query = "SELECT * FROM cidade WHERE id = :id";
        $parametros = ['id' => $id];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) > 0) {
            $registro = $resultado[0];
            $cidade = new CidadeModel();
            $cidade->setId($registro['id']);
            $cidade->setEstado($this->estadoRepository->recuperar($registro['estado_id']));
            $cidade->setNome($registro['nome']);
            return $cidade;
        } else {
            return null;
        }
    }

    public function getAllCidades() {
        $query = "SELECT * FROM cidade";
        $resultado = $this->db->consultar($query);

        return ($this->generateCidadesList($resultado));
    }

    public function getCidadesPorEstado(EstadoModel $estado) : ?array {
        $query = "SELECT * FROM cidade WHERE estado_id = :estado_id";
        $parametros = ['estado_id' => $estado->getId()];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) > 0) {
            return ($this->generateCidadesList($resultado));
        } else {
            return null;
        }
    }

    public function getCidadeByNome($nome) : ?array {
        $query = "SELECT * FROM cidade WHERE nome = :nome";
        $parametros = ['nome' => $nome];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) > 0) {
            return ($this->generateCidadesList($resultado));
        } else {
            return null;
        }
    }

    private function generateCidadesList($cidadesList) : array {
        foreach ($cidadesList as $cidade) {
            $cidadeModel = new CidadeModel();
            
            $cidadeModel->setId($cidade['id']);
            $cidadeModel->setEstado($this->estadoRepository->recuperar($cidade['estado_id']));
            $cidadeModel->setNome($cidade['nome']);
            $cidades[] = $cidadeModel;
        }

        return $cidades;
    }

    public function generateCidadesListJSon($cidadesList) {
        $array_associativo = [];

        foreach ($cidadesList as $cidade) {
            $array_associativo[] = [
                "id" => $cidade->getId(),
                "nome" => $cidade->getNome(),
                "estado" => $cidade->getEstado()
            ];
        }

        // Convertendo o array associativo em JSON
        $json = json_encode($array_associativo);

        // Exibindo o JSON resultante
        return $json;
    }
}