<?php

namespace App\Repositories;

use App\Models\OSModel;
use App\Repositories\ClienteRepository;
use Exception;

class OSRepository
{
    private $db;
    private OSModel $os;

    private array $estagios;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getOS() : OSModel {
        return $this->os;
    }

    public function incluir($os) : bool
    {
        $osAnterior = $os->getOsAnterior();
        if($osAnterior->getOsAnterior())
            $osAnterior = $osAnterior->getOsAnterior()->getId();
        else
            $osAnterior = null;
        $parametros = [
            'tipo' => $os->getTipo(),
            'os_anterior' => $osAnterior,
            'cliente' => $os->getCliente()->getId(),
            'equipamento' => strtoupper($os->getEquipamento()),
            'marca' => strtoupper($os->getMarca()),
            'modelo' => strtoupper($os->getModelo()),
            'serie' => strtoupper($os->getSerie()),
            'senha' => $os->getSenha(),
            'acessorio' => strtoupper($os->getAcessorio()),
            'diagnostico' => strtoupper($os->getDiagnostico()),
            'solucao' => strtoupper($os->getSolucao()),
            'observacao' => strtoupper($os->getObservacao()),
            'estagio' => $os->getEstagio(),
            'data_garantia' => $os->getDataGarantia(),
            'valor_servico' => $os->getValorServico(),
            'valor_peca' => $os->getValorPeca(),
            'pecas_substituidas' => strtoupper($os->getPecasSubstituidas()),
            'created_at' => $os->getCreatedAt(),
            'created_by' => $os->getCreatedBy(),
            'updated_at' => $os->getUpdatedAt(),
            'updated_by' => $os->getUpdatedBy()
        ];
        if($this->db->inserir("os", $parametros)) {
            $os->setId($this->db->getLastInsertId());
            $this->os = $os;
            return true;
        }
        return false;
    }

    public function recuperar($id) : ?OSModel
    {
        $query = "SELECT * FROM os WHERE id = :id";
        
        try {
            $parametros = ['id' => $id];
            $resultado = $this->db->consultar($query, $parametros);
    
            if (count($resultado) == 1) {
                $this->setEstagiosOS($this->generateOS($resultado[0]));
                return $this->generateOS($resultado[0]);
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw new Exception("Nenhuma OS encontrada com o ID fornecido.");
        }
    }

    public function atualizar($os) : bool
    {
        try {
            $dados = [
                'tipo' => $os->getTipo(),
                'os_anterior' => $os->getOsAnterior(),
                'cliente' => $os->getCliente()->getId(),
                'equipamento' => $os->getEquipamento(),
                'marca' => $os->getMarca(),
                'modelo' => $os->getModelo(),
                'serie' => $os->getSerie(),
                'senha' => $os->getSenha(),
                'acessorio' => $os->getAcessorio(),
                'diagnostico' => $os->getDiagnostico(),
                'solucao' => $os->getSolucao(),
                'observacao' => $os->getObservacao(),
                'estagio' => $os->getEstagio(),
                'data_garantia' => $os->getDataGarantia(),
                'valor_servico' => $os->getValorServico(),
                'valor_peca' => $os->getValorPeca(),
                'pecas_substituidas' => $os->getPecasSubstituidas(),
                'created_at' => $os->getCreatedAt(),
                'created_by' => $os->getCreatedBy(),
                'updated_at' => $os->getUpdatedAt(),
                'updated_by' => $os->getUpdatedBy()
            ];

            $condicao = ["id" => $os->getId()];
            return $this->db->atualizar('os', $dados, $condicao) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar OS: " . $e->getMessage());
        }
        return true;
    }

    public function excluir() : bool
    {
        return true;
    }

    public function setEstagiosOS($os) : void
    {
        $estagios = [
            "CANCELADO" => "d-none",
            "CADASTRADO" => "",
            "DIAGNOSTICADO" => "",
            "ORCADO" => "",
            "REPARADO" => "",
            "FATURADO" => "",
            "PAGO" => "",
            "LIBERADO" => "",
            "CONCLUIDO" => "",
        ];

        $keys = array_keys($estagios);
        for ($i = 0; $i < count($keys); $i++) {
            if ($keys[$i] === $os->getEstagio()) {
                if ($os->getEstagio() === "CANCELADO") {
                    $estagios["CANCELADO"] = "";
                } else {
                    $estagios[$keys[$i]] = "completed";
                    if (isset($keys[$i + 1])) {
                        $estagios[$keys[$i + 1]] = "current";
                    }
                }
                break;
            } else if($keys[$i] !== "CANCELADO"){
                $estagios[$keys[$i]] = "completed";
            }
        }

        $this->estagios = $estagios;
    }

    public function getEstagiosOS() : array
    {
        return $this->estagios;
    }

    public function updateEstagio($os) : bool
    {
        try {
            $dados = [
                'estagio' => $os->getEstagio(),
                'updated_at' => $os->getUpdatedAt(),
                'updated_by' => $os->getUpdatedBy()
            ];
            $condicao = [
                "id" => $os->getId()
            ];
            return $this->db->atualizar('os', $dados, $condicao) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar atualizar estágio de OS: " . $e->getMessage());
        }
    }

    private function processarOS($os, $acao) : bool
    {
        try {
            $this->$acao($os);
            $this->updateEstagio($os);
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar processar OS: " . $e->getMessage());
        }
        return true;
    }

    public function registrarDiagnostico($os) : bool
    {
        return $this->processarOS($os, 'atualizar');
    }

    public function gerarOrcamento($os) : bool
    {
        return $this->processarOS($os, 'atualizar');
    }

    public function aprovarOrcamento($os) : bool
    {
        return $this->processarOS($os, 'atualizar');
    }

    public function faturarOS($os) : bool
    {
        return $this->processarOS($os, 'atualizar');
    }

    public function repararOS($os) : bool
    {
        return $this->processarOS($os, 'atualizar');
    }

    public function pagarOS($payment) : bool
    {
        $pagamentoRepository = new PagamentoRepository($this->db);

        $pagamentoRepository->incluir($payment);

        return $this->processarOS($payment->getOs(), 'atualizar');
    }

    public function liberarOS($os) : bool
    {
        return $this->processarOS($os, 'atualizar');
    }
    public function getOSListByEquipamento($equipamento) : ?array
    {
        $osList = [];

        $condicao = [
            'equipamento' => "%".$equipamento."%"
        ];

        $query =
        "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.created_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        WHERE 
            os.equipamento LIKE :equipamento OR
            os.modelo LIKE :equipamento OR
            os.marca LIKE :equipamento OR
            os.serie LIKE :equipamento
        ORDER BY 
            os.created_at DESC;";
        try {
            $resultado = $this->db->consultar($query, $condicao);

            if ($resultado) {
                foreach($resultado as $row) {
                    $osList[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
            }
        } catch (Exception $e) {
            var_dump($e);
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
        return $osList;
    }

    public function getOSListByID($id) : ?array
    {
        $osList = [];

        $condicao = [
            'id' => $id
        ];

        $query =
        "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.created_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        WHERE 
            os.id = :id
        ORDER BY 
            os.created_at DESC;";
        try {
            $resultado = $this->db->consultar($query, $condicao);

            if ($resultado) {
                foreach($resultado as $row) {
                    $osList[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
            }
        } catch (Exception $e) {
            var_dump($e);
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
        return $osList;
    }

    public function getOSListByClienteID($id) : ?array
    {
        $osList = [];

        $condicao = [
            'cliente' => $id
        ];

        $query =
        "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.created_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        WHERE 
            os.cliente = :cliente
        ORDER BY 
            os.created_at DESC;";
        try {
            $resultado = $this->db->consultar($query, $condicao);

            if ($resultado) {
                foreach($resultado as $row) {
                    $osList[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
            }
        } catch (Exception $e) {
            var_dump($e);
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
        return $osList;
    }
    public function getOSListByClienteNome($nome) : ?array
    {
        $osList = [];

        $condicao = [
            'nome' => "%".$nome."%"
        ];

        $query =
        "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.created_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        WHERE 
            pessoa_fisica.nome LIKE :nome
        ORDER BY 
            os.created_at DESC;";
        try {
            $resultado = $this->db->consultar($query, $condicao);

            if ($resultado) {
                foreach($resultado as $row) {
                    $osList[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
            }
        } catch (Exception $e) {
            var_dump($e);
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
        return $osList;
    }

    public function getOSListByClienteCPF($cpf) : ?array
    {
        $osList = [];

        $condicao = [
            'cpf' => "%".$cpf."%"
        ];

        $query =
        "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.created_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        WHERE 
            pessoa_fisica.cpf LIKE :cpf
        ORDER BY 
            os.created_at DESC;";
        try {
            $resultado = $this->db->consultar($query, $condicao);

            if ($resultado) {
                foreach($resultado as $row) {
                    $osList[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
            }
        } catch (Exception $e) {
            var_dump($e);
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
        return $osList;
    }

    private function getOSListByEstagio($estagio, $periodo = []) : ?array
    {
        $condicao = [
            'estagio' => $estagio
        ];

        $dateWhere = "";

        if(count($periodo)) {
            $dateWhere = " AND DATE(created_at) BETWEEN :dataInicial AND :dataFinal";
            $condicao['dataInicial'] = $periodo['dataInicial'];
            $condicao['dataFinal'] = $periodo['dataFinal'];
        }

        $query =
            "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.created_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        WHERE 
            os.estagio = :estagio" . $dateWhere .
        " ORDER BY 
            os.created_at DESC;";
        try {
            $resultado = $this->db->consultar($query, $condicao);

            if ($resultado) {
                $listOS = [];
                foreach($resultado as $row) {
                    $listOS[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
                return $listOS;
            } else {
                return [];
            }
        } catch (Exception $e) {
            var_dump($e);
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
    }

    public function getOSCadastradas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("CADASTRADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("CADASTRADO");
        }

        return $listOS;
    }

    public function getOSDiagnosticadas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("DIAGNOSTICADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("DIAGNOSTICADO");
        }

        return $listOS;
    }

    public function getOSOrcadas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("ORCADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("ORCADO");
        }

        return $listOS;
    }

    public function getOSReparadas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("REPARADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("REPARADO");
        }

        return $listOS;
    }

    public function getOSFaturadas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("FATURADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("FATURADO");
        }

        return $listOS;
    }

    public function getOSPagas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("PAGO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("PAGO");
        }

        return $listOS;
    }

    public function getOSLiberadas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("LIBERADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("LIBERADO");
        }

        return $listOS;
    }

    public function getOSConcluidas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("CONCLUIDO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("CONCLUIDO");
        }

        return $listOS;
    }
    public function getOSCanceladas($periodo = []) : ?array
    {
        $listOS = [];
        if(count($periodo)) {
            $listOS = $this->getOSListByEstagio("CANCELADO", $periodo);
        } else {
            $listOS = $this->getOSListByEstagio("CANCELADO");
        }

        return $listOS;
    }

    public function getListAllOSRecent()
    {
        $query = 
        "SELECT 
            os.id,
            os.estagio,
            DATE_FORMAT(os.created_at, '%d/%m/%Y') AS created_at,
            cliente.preferencia_contato AS preferencia_contato,
            cliente.celular AS celular,
            cliente.email AS email,
            os.equipamento,
            pessoa_fisica.nome AS cliente,
            DATEDIFF(NOW(), os.updated_at) AS n_dias,
            (os.valor_servico + os.valor_peca) AS valor_total
        FROM 
            os
        JOIN 
            cliente ON os.cliente = cliente.id
        JOIN 
            pessoa_fisica ON cliente.id = pessoa_fisica.id
        ORDER BY 
            os.created_at DESC
        LIMIT 30;";

        try {
            $resultado = $this->db->consultar($query, []);

            if ($resultado) {
                $listOS = [];
                foreach($resultado as $row) {
                    if($row['n_dias'] === null){
                        $today = new \DateTime();
                        $createdAt = \DateTime::createFromFormat('d/m/Y', $row['created_at']);
                        $row['n_dias'] = $today->diff($createdAt)->days;
                    }
                    $listOS[] = [
                        'id' => $row['id'],
                        'estagio' => $row['estagio'],
                        'created_at' => $row['created_at'],
                        'preferencia_contato' => $row['preferencia_contato'],
                        'celular' => $row['celular'],
                        'email' => $row['email'],
                        'equipamento' => $row['equipamento'],
                        'cliente' => $row['cliente'],
                        'status' => '',
                        'n_dias' => $row['n_dias'],
                        'valor_total' => $row['valor_total']
                    ];
                }
                return $listOS;
            } else {
                return [];
            }
        } catch (Exception $e) {
            throw new Exception("Nenhuma OS encontrada com o parametro fornecido.");
        }
    }

    public function getListAllOSByEstagio($periodo)
    {
        $query = 
        "SELECT estagio, COUNT(*) AS quantidade
        FROM os
        WHERE created_at >= NOW() - INTERVAL :periodo DAY
        GROUP BY estagio;";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    ucwords(strtolower($row['estagio'])) => $row['quantidade']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getPrazoMedioAtendimento($periodo)
    {
        $query = 
        "SELECT 
            IFNULL(AVG(DATEDIFF(updated_at, created_at)), 0) AS prazo_medio_atendimento
        FROM os
        WHERE estagio = 'CONCLUIDO'
        AND updated_at >= DATE_SUB(NOW(), INTERVAL :periodo DAY);";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    'prazo_medio_atendimento' => $row['prazo_medio_atendimento']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getTaxaConclusao($periodo)
    {
        $query = 
        "SELECT 
            (COUNT(CASE WHEN estagio = 'CONCLUIDO' THEN 1 END) / COUNT(*)) * 100 AS percentual_concluidas
        FROM os
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL :periodo DAY);";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    'percentual_concluidas' => $row['percentual_concluidas']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getTaxaCancelamento($periodo)
    {
        $query = 
        "SELECT 
            (COUNT(CASE WHEN estagio = 'RECUSADO' THEN 1 END) / COUNT(*)) * 100 AS percentual_canceladas
        FROM os
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL :periodo DAY);";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    'percentual_canceladas' => $row['percentual_canceladas']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getCustoMedio($periodo)
    {
        $query = 
        "SELECT 
            AVG(valor_total) AS valor_medio
        FROM (
            SELECT 
                (valor_servico + valor_peca) AS valor_total
            FROM os
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL :periodo DAY)
        ) AS subquery;";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    'valor_medio' => $row['valor_medio']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getTotalServicos($periodo)
    {
        $query =
        "SELECT 
            SUM(valor_servico) AS valor_total_servicos
        FROM 
            os
        WHERE 
            created_at >= DATE_SUB(NOW(), INTERVAL :periodo DAY)
            AND estagio='CONCLUIDO'";

        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    'valor_total_servicos' => $row['valor_total_servicos']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getTotalPecas($periodo)
    {
        $query =
        "SELECT 
            SUM(valor_peca) AS valor_total_pecas
        FROM 
            os
        WHERE 
            created_at >= DATE_SUB(NOW(), INTERVAL :periodo DAY)
            AND estagio='CONCLUIDO'";

        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    'valor_total_pecas' => $row['valor_total_pecas']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getAllOSByCreatedAtLastSixMounths()
    {
        $query = 
        "WITH RECURSIVE last_six_months AS (
            SELECT DATE_FORMAT(NOW(), '%m/%Y') AS mes_ano, NOW() AS date
            UNION ALL
            SELECT DATE_FORMAT(DATE_SUB(date, INTERVAL 1 MONTH), '%m/%Y'), DATE_SUB(date, INTERVAL 1 MONTH)
            FROM last_six_months
            WHERE DATE_SUB(date, INTERVAL 1 MONTH) >= DATE_SUB(NOW(), INTERVAL 5 MONTH)
        )
        SELECT 
            lsm.mes_ano,
            COUNT(os.id) AS quantidade
        FROM
            last_six_months lsm
        LEFT JOIN
            os ON DATE_FORMAT(os.created_at, '%m/%Y') = lsm.mes_ano
        GROUP BY 
            lsm.mes_ano
        ORDER BY 
            STR_TO_DATE(lsm.mes_ano, '%m/%Y');";
        
        $resultado = $this->db->consultar($query, []);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    $row['mes_ano'] => $row['quantidade']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getListAllOSByStatus($periodo)
    {
        $query = 
        "SELECT 
            CASE
                WHEN DATEDIFF(NOW(), COALESCE(updated_at, created_at)) < 2 THEN 'No prazo'
                WHEN DATEDIFF(NOW(), COALESCE(updated_at, created_at)) >= 2 AND DATEDIFF(NOW(), COALESCE(updated_at, created_at)) < 4 THEN 'Atrasadas'
                WHEN DATEDIFF(NOW(), COALESCE(updated_at, created_at)) >= 4 THEN 'Paradas'
                WHEN estagio = 'CONCLUIDO' THEN 'Concluídas'
            END AS status,
            COUNT(*) AS quantidade
        FROM os
        WHERE created_at >= NOW() - INTERVAL :periodo DAY
        GROUP BY status;";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    $row['status'] => $row['quantidade']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getListAllOSByEstagioOrcamento($periodo)
    {
        $query = 
        "SELECT 
            CASE 
                WHEN estagio = 'DIAGNOSTICADO' THEN 'Pendentes'
                WHEN estagio = 'ORCADO' THEN 'Enviados'
                WHEN estagio = 'FATURADO' THEN 'Autorizados'
            END AS estagio,
            COUNT(*) AS quantidade
        FROM os
        WHERE created_at >= NOW() - INTERVAL :periodo DAY
        AND estagio IN ('DIAGNOSTICADO', 'ORCADO', 'FATURADO')
        GROUP BY estagio;";
        
        $parametros = ['periodo' => $periodo];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $list = [];
            foreach($resultado as $row) {
                $list[] = [
                    $row['estagio'] => $row['quantidade']
                ];
            }
            return $list;
        } else {
            return [];
        }
    }

    public function getRepairCostData($periodo)
    {
        $repairCostData = [];

        $query = 
        "SELECT 
            id,
            created_at,
            equipamento,
            marca,
            modelo,
            serie,
            valor_servico,
            valor_peca,
            (valor_servico + valor_peca) AS valor_total
        FROM 
            os
        WHERE 
            DATE(created_at) BETWEEN :data_inicio AND :data_fim";

        $parametros = [
            'data_inicio' => $periodo['formattedStartDate'],
            'data_fim' => $periodo['formattedEndDate']
        ];

        $resultado = $this->db->consultar($query, $parametros);
        
        if ($resultado) {
            $listagem = [];
            foreach($resultado as $row) {
                $listagem[] = [
                    'id' => $row['id'],
                    'created_at' => date('d/m/Y - H:i', strtotime($row['created_at'])),
                    'equipamento' => $row['equipamento'],
                    'marca' => $row['marca'],
                    'modelo' => $row['modelo'],
                    'serie' => $row['serie'],
                    'valor_servico' => $row['valor_servico'],
                    'valor_peca' => $row['valor_peca'],
                    'valor_total' => $row['valor_total']
                ];
            }
            $repairCostData['tabela'] = $listagem;
        } else { 
            return false;
        }

        // Resumo do período
        $queryResumo = 
        "SELECT 
            COUNT(id) AS total_ordens_servico,
            SUM(valor_servico) AS custo_servico,
            SUM(valor_peca) AS custo_peca,
            SUM(valor_servico + valor_peca) AS custo_total_reparos
        FROM 
            os
        WHERE 
            DATE(created_at) BETWEEN :data_inicio AND :data_fim";

        $resultado = $this->db->consultar($queryResumo, $parametros);

        if ($resultado) {
            foreach($resultado as $row) {
                $repairCostData['total_ordens_servico'] = $row['total_ordens_servico'];
                $repairCostData['custo_servico'] = $row['custo_servico'];
                $repairCostData['custo_peca'] = $row['custo_peca'];
                $repairCostData['custo_total_reparos'] = $row['custo_total_reparos'];
            }
        }
        
        // Ordem de serviço mais cara
        $queryMaisCara = 
        "SELECT 
            id,
            equipamento,
            (valor_servico + valor_peca) AS custo_total
        FROM 
            os
        WHERE 
            DATE(created_at) BETWEEN :data_inicio AND :data_fim
        ORDER BY 
            custo_total DESC
        LIMIT 1";

        $resultado = $this->db->consultar($queryMaisCara, $parametros);

        if ($resultado) {
            foreach($resultado as $row) {
                $repairCostData['id_os_mais_cara'] = $row['id'];
                $repairCostData['equipamento_os_mais_cara'] = $row['equipamento'];
                $repairCostData['custo_total_os_mais_cara'] = $row['custo_total'];
            }
        }

        // Ordem de serviço mais barata
        $queryMaisBarata = 
        "SELECT 
            id,
            equipamento,
            (valor_servico + valor_peca) AS custo_total
        FROM 
            os
        WHERE 
            DATE(created_at) BETWEEN :data_inicio AND :data_fim
        ORDER BY 
            custo_total ASC
        LIMIT 1";

        $resultado = $this->db->consultar($queryMaisBarata, $parametros);

        if ($resultado) {
            foreach($resultado as $row) {
                $repairCostData['id_os_mais_barata'] = $row['id'];
                $repairCostData['equipamento_os_mais_barata'] = $row['equipamento'];
                $repairCostData['custo_total_os_mais_barata'] = $row['custo_total'];
            }
        }

        // Custo médio por ordem de serviço
        $queryCustoMedio = 
        "SELECT 
            AVG(valor_servico + valor_peca) AS custo_medio
        FROM 
            os
        WHERE 
            DATE(created_at) BETWEEN :data_inicio AND :data_fim";

        $resultado = $this->db->consultar($queryCustoMedio, $parametros);

        if ($resultado) {
            foreach($resultado as $row) {
                $repairCostData['custo_medio'] = (float) $row['custo_medio'];
            }
        }

        return $repairCostData;
    }

    public function getTechnicalPerformanceData($periodo)
    {
        $technicalPerformanceData = [];

        $query =
        "SELECT
            COUNT(*) AS total_ordens_servico,
            AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) AS tempo_medio_resolucao,
            SUM(CASE WHEN tipo = 'GARANTIA' THEN 1 ELSE 0 END) / COUNT(*) * 100 AS taxa_retrabalho
        FROM
            os
        WHERE
            estagio = 'CONCLUIDO' AND
            DATE(created_at) BETWEEN :data_inicio AND :data_fim;";

        $parametros = [
            'data_inicio' => $periodo['formattedStartDate'],
            'data_fim' => $periodo['formattedEndDate']
        ];

        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            foreach($resultado as $row) {
                $technicalPerformanceData['total_ordens_servico'] = $row['total_ordens_servico'];
                $technicalPerformanceData['tempo_medio_resolucao'] = $row['tempo_medio_resolucao'];
                $technicalPerformanceData['taxa_retrabalho'] = $row['taxa_retrabalho'];
            }
        }
        return $technicalPerformanceData;
    }

    public function getStatusOSReportData($periodo)
    {
        $statusOSData = [];

        $query =
        "SELECT 
            estagio,
            COUNT(*) AS quantidade,
            AVG(TIMESTAMPDIFF(HOUR, created_at, updated_at)) AS tempo_medio_resolucao
        FROM 
            os
        WHERE 
            DATE(created_at) BETWEEN :data_inicio AND :data_fim
        GROUP BY 
            estagio
        ORDER BY 
            quantidade DESC;";

        $parametros = [
            'data_inicio' => $periodo['formattedStartDate'],
            'data_fim' => $periodo['formattedEndDate']
        ];

        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $listagem = [];
            $totalOSConcluidas = 0;
            $tempoMedioResolucao = 0;
            foreach($resultado as $row) {
                $listagem[] = [
                    'estagio' => $row['estagio'],
                    'quantidade' => $row['quantidade'],
                    'tempo_medio_resolucao' => round($row['tempo_medio_resolucao'])
                ];
                if($row['estagio'] === "CONCLUIDO") {
                    $totalOSConcluidas = $row['quantidade'];
                    $tempoMedioResolucao = $row['tempo_medio_resolucao'];
                }
            }

            $statusOSData['tempo_medio_resolucao'] = round($tempoMedioResolucao);
            $statusOSData['total_os_concluidas'] = $totalOSConcluidas;
            $statusOSData['tabela'] = $listagem;
        }
        return $statusOSData;
    }

    public function getCustomerOSReportData($periodo)
    {
        $statusOSData = [];

        $query =
        "SELECT 
            pf.nome AS nome_cliente,
            COUNT(o.id) AS ordens_abertas,
            SUM(CASE WHEN o.estagio = 'CONCLUIDO' THEN 1 ELSE 0 END) AS ordens_concluidas,
            SUM(CASE WHEN o.estagio != 'CONCLUIDO' THEN 1 ELSE 0 END) AS ordens_pendentes
        FROM 
            os o
        JOIN 
            cliente c ON o.cliente = c.id
        JOIN 
            pessoa_fisica pf ON c.id = pf.id
        WHERE
            DATE(o.created_at) BETWEEN :data_inicio AND :data_fim
        GROUP BY 
            pf.nome
        ORDER BY 
            pf.nome;";

        $parametros = [
            'data_inicio' => $periodo['formattedStartDate'],
            'data_fim' => $periodo['formattedEndDate']
        ];

        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $listagem = [];
            foreach($resultado as $row) {
                $listagem[] = [
                    'nome_cliente' => $row['nome_cliente'],
                    'ordens_abertas' => $row['ordens_abertas'],
                    'ordens_concluidas' => $row['ordens_concluidas'],
                    'ordens_pendentes' => $row['ordens_pendentes']
                ];
            }
            $statusOSData['tabela'] = $listagem;
        } else {
            return [];
        }
        return $statusOSData;
    }

    public function getPaymentsReportData($periodo) : array
    {
        $statusOSData = [];

        $query =
        "SELECT 
            COUNT(p.id) OVER () AS qtd_pagamentos,
            SUM(p.valor) OVER () AS valor_total_geral,
            DATE_FORMAT(p.data_pagamento, '%d/%m/%Y') AS data_pagamento,
            o.id AS numero_os,
            pf.nome AS nome_cliente,
            o.valor_peca,
            o.valor_servico,
            (o.valor_peca + o.valor_servico) AS valor_total,
            p.metodo_pagamento
        FROM 
            pagamento p
        JOIN 
            os o ON p.os = o.id
        JOIN 
            cliente c ON o.cliente = c.id
        JOIN 
            pessoa_fisica pf ON c.id = pf.id
        WHERE
            DATE(p.data_pagamento) BETWEEN :data_inicio AND :data_fim
        ORDER BY 
            p.data_pagamento, o.id, p.metodo_pagamento;";

        $parametros = [
            'data_inicio' => $periodo['formattedStartDate'],
            'data_fim' => $periodo['formattedEndDate']
        ];

        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $listagem = [];
            foreach($resultado as $row) {
                $statusOSData['qtd_pagamentos'] = $row['qtd_pagamentos'];
                $statusOSData['valor_total_geral'] = (float) $row['valor_total_geral'];
                $listagem[] = [
                    'data_pagamento' => $row['data_pagamento'],
                    'numero_os' => $row['numero_os'],
                    'nome_cliente' => $row['nome_cliente'],
                    'valor_peca' => (float) $row['valor_peca'],
                    'valor_servico' => (float) $row['valor_servico'],
                    'valor_total' => (float) $row['valor_total'],
                    'metodo_pagamento' => $row['metodo_pagamento']
                ];
            }
            $statusOSData['tabela'] = $listagem;
        } else {
            return [];
        }
        return $statusOSData;
    }

    public function getBirthdaysReportData($periodo) : array
    {
        $statusOSData = [];

        $query = "
        SELECT 
            c.id AS cliente_id,
            pf.nome AS nome_cliente,
            pf.cpf,
            DATE_FORMAT(pf.data_nascimento, '%d/%m/%Y') AS data_nascimento,
            TIMESTAMPDIFF(YEAR, pf.data_nascimento, CURDATE()) AS idade,
            c.tipo,
            c.email,
            c.celular,
            CASE 
                WHEN c.preferencia_contato = 0 THEN 'Nenhuma'
                WHEN c.preferencia_contato = 1 THEN 'Mensagem'
                WHEN c.preferencia_contato = 2 THEN 'Ligação'
                WHEN c.preferencia_contato = 3 THEN 'Mensagem ou Ligação'
                ELSE 'Indefinido'
            END AS preferencia_contato,
            CONCAT(c.rua, ', ', c.numero, ', ', c.bairro, IF(c.complemento IS NOT NULL, CONCAT(', ', c.complemento), ''), ', ', cidade.nome, ', ', c.cep) AS endereco_completo
        FROM 
            cliente c
        JOIN 
            pessoa_fisica pf ON c.id = pf.id
        JOIN 
            cidade ON c.cidade = cidade.id
        WHERE
            DATE_FORMAT(pf.data_nascimento, '%m-%d') BETWEEN DATE_FORMAT(:data_inicio, '%m-%d') AND DATE_FORMAT(:data_fim, '%m-%d')
        ORDER BY 
            DATE_FORMAT(pf.data_nascimento, '%m-%d');";

        $parametros = [
            'data_inicio' => $periodo['formattedStartDate'],
            'data_fim' => $periodo['formattedEndDate']
        ];

        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            $listagem = [];
            foreach($resultado as $row) {
                $listagem[] = [
                    'cliente_id' => $row['cliente_id'],
                    'nome_cliente' => $row['nome_cliente'],
                    'cpf' => $row['cpf'],
                    'data_nascimento' => $row['data_nascimento'],
                    'idade' => (int) $row['idade'],
                    'email' => $row['email'],
                    'celular' => $row['celular'],
                    'preferencia_contato' => $row['preferencia_contato'],
                    'endereco_completo' => $row['endereco_completo'],
                ];
            }
            $statusOSData['tabela'] = $listagem;
        } else {
            return [];
        }
        return $statusOSData;
    }
    private function generateOSList($osList) : array
    {
        $lista = [];

        foreach($osList as $os){
            $lista[] = $this->generateOS($os);
        }

        return $lista;
    }

    public function generateOSListJSon($resultado) {
        header('Content-Type: application/json');
        echo json_encode($this->generateOSList($resultado), JSON_PRETTY_PRINT);
    }

    private function generateOS($reg) : OSModel
    {
        $os = null;
        $osAnterior = null;
        
        if($reg['os_anterior'])
            $osAnterior = $this->recuperar($reg['os_anterior']);

        $clienteRepository = new ClienteRepository($this->db);
        $cliente = $clienteRepository->recuperar($reg['cliente']);

        $os = new OSModel();
        
        $os->setId($reg['id']);
        $os->setTipo($reg['tipo']);
        $os->setOsAnterior($osAnterior);
        $os->setCliente($cliente);
        $os->setEquipamento(strtoupper($reg['equipamento']));
        $os->setMarca(strtoupper($reg['marca']));
        $os->setModelo(strtoupper($reg['modelo']));
        $os->setSerie(strtoupper($reg['serie']));
        $os->setSenha($reg['senha']);
        $os->setAcessorio(strtoupper($reg['acessorio']));
        $os->setDiagnostico(strtoupper($reg['diagnostico']));
        $os->setSolucao(strtoupper($reg['solucao']));
        $os->setObservacao(strtoupper($reg['observacao']));
        $os->setEstagio($reg['estagio']);
        $os->setDataGarantia($reg['data_garantia']);
        $os->setValorServico($reg['valor_servico']);
        $os->setValorPeca($reg['valor_peca']);
        $os->setPecasSubstituidas(strtoupper($reg['pecas_substituidas']));
        $os->setCreatedAt($reg['created_at']);
        $os->setCreatedBy($reg['created_by']);
        $os->setUpdatedAt($reg['updated_at']);
        $os->setUpdatedBy($reg['updated_by']);

        return $os;
    }
}