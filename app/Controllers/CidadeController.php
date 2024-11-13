<?php

namespace App\Controllers;

use App\Repositories\CidadeRepository;
use App\Repositories\EstadoRepository;

class CidadeController {
    private CidadeRepository $cidadeRepository;
    private EstadoRepository $estadoRepository;

    public function __construct($conn) {
        $this->cidadeRepository = new CidadeRepository($conn);
        $this->estadoRepository = new EstadoRepository($conn);
    }

    public function listarCidadesPorEstado($estado_id) {
        $cidades = $this->cidadeRepository->getCidadesPorEstado($this->estadoRepository->recuperar($estado_id['estado_id']));
        $cidadesJSon = $this->cidadeRepository->generateCidadesListJSon($cidades);
        echo $cidadesJSon;
    }

    public function searchCidade($busca)
    {
        // Verifica se foi fornecido o parâmetro 'nome' na busca
        if (isset($busca['nome'])) {
            return $this->getCidadeByNome($busca['nome']);
        }
        // Verifica se foi fornecido o parâmetro 'id' na busca
        elseif (isset($busca['id'])) {
            return $this->getCidadeById($busca['id']);
        }
        // Se nenhum critério de busca válido foi fornecido, retorna null
        else {
            return null;
        }
    }
    
    public function getCidadeByNome($nome)
    {   
        $resultado [] = $this->cidadeRepository->getCidadeByNome($nome);
        return $resultado ? $this->cidadeRepository->generateCidadesListJSon($resultado) : [];
    }

    public function getCidadeById($id)
    {
        $resultado [] = $this->cidadeRepository->recuperar($id);
        //echo "<pre>".var_dump($this->cidadeRepository->generateCidadesListJSon($resultado))."</pre>";
        if(!empty($resultado[0])) {
            //echo "<pre>".var_dump($this->cidadeRepository->generateCidadesListJSon($resultado))."</pre>";
            header('Content-Type: application/json');
            echo  $this->cidadeRepository->generateCidadesListJSon($resultado);
        }
        else
            return [];
    }
}