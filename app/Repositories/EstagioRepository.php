<?php

namespace App\Repositories;

use App\Models\EstagioModel;
class EstagioRepository
{
    private $db;
    private EstagioModel $estagio;

    private array $historico = [
        "RECEBIMENTO" => null,
        "DIAGNOSTICO" => null,
        "ORCAMENTO" => null,
        "REPARO" => null,
        "FATURAMENTO" => null,
        "PAGAMENTO" => null,
        "LIBERACAO" => null,
        "CONCLUSAO" => null,
    ];

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getEstagio()
    {
        return $this->estagio;
    }
    private function setHistorico($historico)
    {
        $this->historico = $historico;
    }

    public function getHistorico() : array
    {
        return $this->historico;
    }

    public function incluir(EstagioModel $estagio)
    {
        $parametros = [
            "id" => $estagio->getId(),
            "os_id" => $estagio->getOsId(),
            "nome" => $estagio->getNome(),
            "finished_at" => $estagio->getFinishedAt(),
            "finished_by" => $estagio->getFinishedBy(),
            "status" => $estagio->getStatus(),
        ];
        if($this->db->inserir("os", $parametros)) {
            $estagio->setId($this->db->getLastInsertId());
            $this->estagio = $estagio;
            return true;
        }
        return false;
    }

    public function recuperar()
    {

    }

    public function atualizar()
    {

    }

    public function excluir()
    {

    }

    private function generateEstagioList($estagioList) : array
    {
        $lista = [];

        foreach($estagioList as $os){
            $lista[] = $this->generateEstagio($os);
        }

        return $lista;
    }

    private function generateEstagio($reg) : EstagioModel
    {
        $estagio = null;

        $clienteRepository = new ClienteRepository($this->db);
        $cliente = $clienteRepository->recuperar($reg['cliente']);

        $estagio = new EstagioModel();

        $estagio->setId($reg['id']);
        $estagio->setTipo($reg['tipo']);
        $estagio->setOsAnterior($estagioAnterior);
        $estagio->setCliente($cliente);
        $estagio->setEquipamento($reg['equipamento']);
        $estagio->setMarca($reg['marca']);
        $estagio->setModelo($reg['modelo']);
        $estagio->setSerie($reg['serie']);
        $estagio->setSenha($reg['senha']);
        $estagio->setAcessorio($reg['acessorio']);
        $estagio->setDiagnostico($reg['diagnostico']);
        $estagio->setSolucao($reg['solucao']);
        $estagio->setObservacao($reg['observacao']);
        $estagio->setEstagio($reg['estagio']);
        $estagio->setDataGarantia($reg['data_garantia']);
        $estagio->setValorServico($reg['valor_servico']);
        $estagio->setValorPeca($reg['valor_peca']);
        $estagio->setCreatedAt($reg['created_at']);
        $estagio->setCreatedBy($reg['created_by']);
        $estagio->setUpdatedAt($reg['updated_at']);
        $estagio->setUpdatedBy($reg['updated_by']);

        return $estagio;
    }
}