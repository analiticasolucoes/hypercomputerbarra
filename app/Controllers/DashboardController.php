<?php

namespace App\Controllers;

use App\Repositories\OSRepository;
use App\Services\Session;

class DashboardController {
    private OSRepository $osRepository;

    public function __construct($conn) {
        $this->osRepository = new OSRepository($conn);
    }

    public function index() {
        $username = ucwords(strtolower(Session::get('username')));
        $perfil = ucwords(strtolower(Session::get('perfil')));
        $listaOS = $this->osRepository->getListAllOSRecent();

        for($i=0; $i < count($listaOS); $i++) {
            if($listaOS[$i]['preferencia_contato'] == 1 || $listaOS[$i]['preferencia_contato'] == 3) {
                $listaOS[$i]['tooltipMessage'] = $listaOS[$i]['email'];
            } else {
                $listaOS[$i]['tooltipMessage'] = "#";
            }

            if($listaOS[$i]['preferencia_contato'] >= 2) {
                $listaOS[$i]['tooltipTelephone'] = $listaOS[$i]['celular'];
            } else {
                $listaOS[$i]['tooltipTelephone'] = "#";
            }

            if($listaOS[$i]['n_dias'] <= 1) {
                $listaOS[$i]['status'] = "No prazo";
            }

            if($listaOS[$i]['n_dias'] > 1) {
                $listaOS[$i]['status'] = "Atrasada";
            }

            if($listaOS[$i]['n_dias'] > 3) {
                $listaOS[$i]['status'] = "Parada";
            }

            if($listaOS[$i]['estagio'] === "CONCLUIDO" || $listaOS[$i]['estagio'] === "CANCELADO") {
                $listaOS[$i]['status'] = "-";
                $listaOS[$i]['n_dias'] = "-";
            }
        }
        include '../app/Views/dashboard.php';
    }
}