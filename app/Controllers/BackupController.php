<?php

namespace App\Controllers;

require_once '../app/repositories/CidadeRepository.php';

class CidadeController {
    private CidadeRepository $cidadeRepository;

    public function __construct($conn) {
        $this->cidadeRepository = new CidadeRepository($conn);
    }

    public function listarCidadesPorEstado($estado_id) {
        $cidades = $this->cidadeRepository->getCidadesPorEstado($estado_id['estado_id']);

        $cidadesJSon = $this->cidadeRepository->generateCidadesListJSon($cidades);

        echo $cidadesJSon;
    }
}