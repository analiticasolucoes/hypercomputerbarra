<?php

namespace App\Controllers;

use App\Controllers\{ArquivoController, ViewController};
use App\Models\{OSModel, PagamentoModel};
use App\Repositories\{CidadeRepository, ClienteRepository, OSRepository, PagamentoRepository, UserRepository};
use App\Services\{DateHandler, Email, GeneratePDF, Pagination, Session, SMS};
use DateTime;
use DateTimeZone;

class OSController
{
    private OSRepository $osRepository;
    private ClienteRepository $clienteRepository;
    private CidadeRepository $cidadeRepository;
    private UserRepository $userRepository;

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->osRepository = new OSRepository($conn);
        $this->clienteRepository = new ClienteRepository($conn);
        $this->cidadeRepository = new CidadeRepository($conn);
        $this->userRepository = new UserRepository($conn);
    }

    public function index()
    {
        include '../app/Views/os/add-step-1.php';
    }

    public function addSecoundStep()
    {
        include '../app/Views/os/add-step-2.php';
    }

    public function addThirdStep()
    {
        include '../app/Views/os/add-step-3.php';
    }    

    public function addHandler()
    {
        $os = json_decode(file_get_contents('php://input'), true);

        $cliente = $this->clienteRepository->recuperar($os['id']);
        $userId = Session::get("user_id");
        $created_at = DateHandler::converterData($os['data-abertura'], "d/m/Y H:i");

        $resultado = $this->osRepository->incluir(new OSModel(
            0,
            "NOVA",
            new OSModel(),
            $cliente,
            $os['tipo-equipamento'],
            $os['marca'],
            $os['modelo'],
            $os['serie'],
            $os['senha'],
            $os['acessorio'],
            $os['diagnostico'],
            "",
            $os['observacao'],
            "CADASTRADO",
            "",
            0,
            0,
            "",
            $created_at,
            $userId,
            "",
            ""
        ));

        if($resultado) {
            // Disparar notificacao via e-mail com numero da OS
            $os = $this->osRepository->getOS();
            if ($os->getCliente()->getPreferenciaContato() >= 2) {
                $email = new Email();

                $email->loadTemplateMessage(
                    "../app/Views/templates/new-os-email.html",
                    [
                        "cliente_nome" => $os->getCliente()->getNome(),
                        "os_numero" => "OS" . $os->getId() . "N",
                        "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
                        "os_equipamento" => $os->getEquipamento(),
                        "os_responsavel" => Session::get("username"),
                        "ano_atual" => date("Y")
                    ]);
                $email->sendEmail(
                    $os->getCliente()->getEmail(),
                    "Nova Ordem de Servico - Hyper Computer"
                );
            }
            /*if ($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
                $to = $os->getCliente()->getCelular();
                $to = ltrim($to, "0");

                $sms = new SMS();
                $sms->send(
                    $to,
                    "Hyper Computer informa: Nova ordem de serviço N.º: {$os->getId()} aberta em {$os->getCreatedAt()} para o equipamento {$os->getEquipamento()}. Prazo de atendimento médio de 2 (dois) dias úteis para envio do orçamento."
                );
            }*/
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function edit($os)
    {
        $osToEdit = $this->osRepository->recuperar($os['id']);
        $dataCriacao = DateHandler::converterData($osToEdit->getCreatedAt(), "Y-m-d H:i:s", "d/m/Y H:i");
        $cidade = $this->cidadeRepository->recuperar($osToEdit->getCliente()->getCidade());

        include '../app/Views/os/edit.php';
    }

    public function editHandler($os)
    {
        $osToUpdate = $this->osRepository->recuperar($os['id']);

        $osToUpdate->setEquipamento($os['tipo-equipamento']);
        $osToUpdate->setMarca($os['marca']);
        $osToUpdate->setModelo($os['modelo']);
        $osToUpdate->setSerie($os['serie']);
        if(isset($os['senha'])) $osToUpdate->setSerie($os['senha']);
        $osToUpdate->setAcessorio($os['acessorio']);
        $osToUpdate->setObservacao($os['observacao']);

        $resultado = $this->osRepository->atualizar($osToUpdate);

        if($resultado) {
            ViewController::render(
                "sucess",
                "Edição - Ordem de Serviço",
                "Ordem de Serviço editada com sucesso!",
                "/os/show?id=" . $osToUpdate->getId(),
                "Voltar para Ordem de Serviço",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Edição - Ordem de Serviço",
                "Não foi possível editar a Ordem de Serviço...!",
                "/os/show?id=" . $osToUpdate->getId(),
                "Voltar para Ordem de Serviço",
                ["error" => ""]
            );
        }
    }

    public function cancel()
    {
        $os = json_decode(file_get_contents('php://input'), true);

        $osToCancel = $this->osRepository->recuperar($os['id']);
        $osToCancel->setEstagio("CANCELADO");
        $cancelDate = new DateTime();
        $fusoHorario = new DateTimeZone('America/Sao_Paulo');
        $cancelDate->setTimezone($fusoHorario);
        $osToCancel->setUpdatedAt($cancelDate->format("Y-m-d H:i:s"));
        $osToCancel->setUpdatedBy(Session::get("user_id"));

        $resultado = $this->osRepository->atualizar($osToCancel);

        if($resultado) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'message' => 'Ordem de serviço cancelada com sucesso.'
            ]);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Erro ao cancelar ordem de serviço.'
            ]);
        }
    }

    public function diagnosis($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSCadastradas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/diagnosis", count($listaOS), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/diagnosis.php");
    }

    public function diagnosisDetails($id)
    {
        $os = $this->osRepository->recuperar($id['id']);

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = DateHandler::converterData($updatedAt, "Y-m-d H:i:s", "d/m/Y - H:i");
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $data = [
            "os_id" => $os->getId(),
            "created_at" => DateHandler::converterData($os->getCreatedAt(), "Y-m-d H:i:s", "d/m/Y - H:i"),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao()
        ];

        echo(ViewController::show("../app/Views/os/diagnosis-details.php", $data));
    }

    public function diagnosisHandler()
    {
        $diagnosis = json_decode(file_get_contents('php://input'), true);
        $os = $this->osRepository->recuperar($diagnosis['id']);

        $dataAtual = new DateTime();
        $dataAtualFormatada = $dataAtual->format('Y-m-d H:i:s');

        $os->setDiagnostico($diagnosis['diagnostico']);
        $os->setSolucao($diagnosis['solucao']);
        $os->setObservacao($diagnosis['observacao']);
        $os->setEstagio("DIAGNOSTICADO");
        $os->setUpdatedAt($dataAtualFormatada);
        $os->setUpdatedBy(Session::get('user_id'));

        if($this->osRepository->registrarDiagnostico($os)) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function budget($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSDiagnosticadas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/budget", count($listaOS), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/budget.php");
    }

    public function budgetDetails($id)
    {
        $os = $this->osRepository->recuperar($id['id']);

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = DateHandler::converterData($updatedAt, "Y-m-d H:i:s", "d/m/Y - H:i");
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $data = [
            "os_id" => $os->getId(),
            "created_at" => DateHandler::converterData($os->getCreatedAt(), "Y-m-d H:i:s", "d/m/Y - H:i"),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "valor_peca" => number_format($os->getValorPeca(), 2, ',', '.'),
            "valor_servico" => number_format($os->getValorServico(), 2, ',', '.'),
            "valor_total" => number_format(($os->getValorPeca()+$os->getValorServico()), 2, ',', '.'),
        ];

        echo(ViewController::show("../app/Views/os/budget-details.php", $data));
    }

    public function budgetHandler()
    {
        $budget = json_decode(file_get_contents('php://input'), true);
        $os = $this->osRepository->recuperar($budget['id']);

        $valorServico = $budget['valor-servico'];
        $valorServico = str_replace('.', '', $valorServico);
        $valorServico = str_replace(',', '.', $valorServico);

        $valorPeca = $budget['valor-pecas'];
        $valorPeca = str_replace('.', '', $valorPeca);
        $valorPeca = str_replace(',', '.', $valorPeca);

        $os->setValorServico((float)$valorServico);
        $os->setValorPeca((float)$valorPeca);
        $os->setObservacao($budget['observacao']);
        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('Y-m-d H:i:s');
        $os->setUpdatedAt($dataFormatada);
        $os->setUpdatedBy(Session::get('user_id'));

        if($this->osRepository->gerarOrcamento($os)) {
            // Adicionar a lógica para envio do orçamento ao cliente neste bloco (via e-mail, sms, WhatsApp, etc...)
            // Disparar notificacao via e-mail com orçamento
            if($os->getCliente()->getPreferenciaContato() >= 2) {
                $email = new Email();

                $email->loadTemplateMessage(
                    "../app/Views/templates/new-orcamento-email.html",
                    [
                        "os_id" => $os->getId(),
                        "os_numero" => "OS" . $os->getId() . "N",
                        "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
                        "cliente_nome" => $os->getCliente()->getNome(),
                        "cliente_endereco" => $os->getCliente()->getRua(),
                        "cliente_bairro" => $os->getCliente()->getBairro(),
                        "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
                        "cliente_cep" => $os->getCliente()->getCep(),
                        "cliente_celular" => $os->getCliente()->getCelular(),
                        "equipamento_nome" => $os->getEquipamento(),
                        "equipamento_marca" => $os->getMarca(),
                        "equipamento_modelo" => $os->getEquipamento(),
                        "equipamento_serie" => $os->getSerie(),
                        "defeito" => $os->getDiagnostico(),
                        "solucao" => $os->getSolucao(),
                        "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
                        "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
                        "orcamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
                        "ano_atual" => date("Y")
                    ]);
                $email->sendEmail(
                    $os->getCliente()->getEmail(),
                    "Orçamento de Serviço - Hyper Computer"
                );
            }
            /*if ($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
                $to = $os->getCliente()->getCelular();
                $to = ltrim($to, "0");

                $sms = new SMS();
                $sms->send(
                    $to,
                    "Hyper Computer informa: Orçamento da ordem de serviço N.º: {$os->getId()} aberta em {$os->getCreatedAt()} para o equipamento {$os->getEquipamento()} aguardando aprovação. Verifique seu e-mail ou entre em contato no número (21) 3411-6826 / (21) 3328-0354"
                );
            }*/
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function budgetApprove()
    {
        $budget = json_decode(file_get_contents('php://input'), true);
        $os = $this->osRepository->recuperar($budget['id']);

        $os->setEstagio("ORCADO");
        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('Y-m-d H:i:s');
        $os->setUpdatedAt($dataFormatada);
        $os->setUpdatedBy(Session::get('user_id'));

        if($this->osRepository->aprovarOrcamento($os)) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function budgetEmailApprove($os)
    {
        // Sanitiza entrada de dados
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        
        // Escapa caracteres especiais usando htmlspecialchars para prevenir XSS
        $osID = htmlspecialchars($id, ENT_QUOTES, 'UTF-8');
        
        $os = $this->osRepository->recuperar($osID);

        if (!$os) {
            ViewController::render(
                "error",
                "Orçamento - Ordem de Serviço",
                "Não foi possível aprovar o orçamento... Ordem de serviço não encontrada!",
                "",
                "",
                []
            );
            return;
        }

        if($os->getEstagio() !== "DIAGNOSTICADO") {
            ViewController::render(
                "error",
                "Orçamento - Ordem de Serviço",
                "Não foi possível aprovar o orçamento... Estágio da Ordem de Serviço não permite aprovação!",
                "",
                "",
                []
            );
            return;
        }
        
        $os->setEstagio("ORCADO");
        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('Y-m-d H:i:s');
        $os->setUpdatedAt($dataFormatada);

        if($this->osRepository->aprovarOrcamento($os)) {
            ViewController::render(
                "sucess",
                "Orçamento - Ordem de Serviço",
                "Orçamento aprovado com sucesso!",
                "https://www.hypercomputer.com.br/",
                "Venha conhecer o site oficial da Hyper Computer na internet!",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Orçamento - Ordem de Serviço",
                "Não foi possível aprovar o orçamento...!",
                "",
                "",
                []
            );
        }
    }

    public function repair($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSOrcadas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/repair", count($listaOS), 5, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/repair.php");
    }

    public function repairDetails($id)
    {
        $os = $this->osRepository->recuperar($id['id']);

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = DateHandler::converterData($updatedAt, "Y-m-d H:i:s", "d/m/Y - H:i");
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $data = [
            "os_id" => $os->getId(),
            "created_at" => DateHandler::converterData($os->getCreatedAt(), "Y-m-d H:i:s", "d/m/Y - H:i"),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "valor_peca" => number_format($os->getValorPeca(), 2, ',', '.'),
            "valor_servico" => number_format($os->getValorServico(), 2, ',', '.'),
            "valor_total" => number_format(($os->getValorPeca()+$os->getValorServico()), 2, ',', '.'),
        ];

        echo(ViewController::show("../app/Views/os/repair-details.php", $data));
    }

    public function repairHandler()
    {
        $repair = json_decode(file_get_contents('php://input'), true);

        $os = $this->osRepository->recuperar($repair['id']);

        $os->setEstagio("REPARADO");
        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('Y-m-d H:i:s');
        $os->setPecasSubstituidas($repair['reparo-pecas']);
        $os->setObservacao($repair['observacao']);
        $os->setUpdatedAt($dataFormatada);
        $os->setUpdatedBy(Session::get('user_id'));

        if($this->osRepository->repararOS($os)) {
            // Adicionar a lógica para envio do orçamento ao cliente neste bloco (via e-mail, sms, WhatsApp, etc...)
            // Disparar notificacao via e-mail com orçamento
            if($os->getCliente()->getPreferenciaContato() >= 2) {
                $email = new Email();

                $email->loadTemplateMessage(
                    "../app/Views/templates/new-retirada-email.html",
                    [
                        "os_numero" => "OS" . $os->getId() . "N",
                        "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
                        "cliente_nome" => $os->getCliente()->getNome(),
                        "cliente_endereco" => $os->getCliente()->getRua(),
                        "cliente_bairro" => $os->getCliente()->getBairro(),
                        "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
                        "cliente_cep" => $os->getCliente()->getCep(),
                        "cliente_celular" => $os->getCliente()->getCelular(),
                        "equipamento_nome" => $os->getEquipamento(),
                        "equipamento_marca" => $os->getMarca(),
                        "equipamento_modelo" => $os->getEquipamento(),
                        "equipamento_serie" => $os->getSerie(),
                        "defeito" => $os->getDiagnostico(),
                        "solucao" => $os->getSolucao(),
                        "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
                        "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
                        "faturamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
                        "ano_atual" => date("Y")
                    ]);
                $email->sendEmail(
                    $os->getCliente()->getEmail(),
                    "Reparo de Serviço - Hyper Computer"
                );
            }
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function charge($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSReparadas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/charge", count($listaOS), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/charge.php");
    }

    public function chargeDetails($id)
    {
        $os = $this->osRepository->recuperar($id['id']);

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = DateHandler::converterData($updatedAt, "Y-m-d H:i:s", "d/m/Y - H:i");
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $data = [
            "os_id" => $os->getId(),
            "created_at" => DateHandler::converterData($os->getCreatedAt(), "Y-m-d H:i:s", "d/m/Y - H:i"),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_pecas_substituidas" => $os->getPecasSubstituidas(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "valor_peca" => number_format($os->getValorPeca(), 2, ',', '.'),
            "valor_servico" => number_format($os->getValorServico(), 2, ',', '.'),
            "valor_total" => number_format(($os->getValorPeca()+$os->getValorServico()), 2, ',', '.'),
        ];

        echo(ViewController::show("../app/Views/os/charge-details.php", $data));
    }

    public function chargeHandler()
    {
        $charge = json_decode(file_get_contents('php://input'), true);
        $os = $this->osRepository->recuperar($charge['id']);

        $os->setEstagio("FATURADO");
        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('Y-m-d H:i:s');
        $os->setUpdatedAt($dataFormatada);
        $os->setUpdatedBy(Session::get('user_id'));

        if($this->osRepository->faturarOS($os)) {
            // Adicionar a lógica para envio do orçamento ao cliente neste bloco (via e-mail, sms, WhatsApp, etc...)
            // Disparar notificacao via e-mail com orçamento
            if($os->getCliente()->getPreferenciaContato() >= 2) {
                $email = new Email();

                $email->loadTemplateMessage(
                    "../app/Views/templates/new-faturamento-email.html",
                    [
                        "os_numero" => "OS" . $os->getId() . "N",
                        "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
                        "cliente_nome" => $os->getCliente()->getNome(),
                        "cliente_endereco" => $os->getCliente()->getRua(),
                        "cliente_bairro" => $os->getCliente()->getBairro(),
                        "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
                        "cliente_cep" => $os->getCliente()->getCep(),
                        "cliente_celular" => $os->getCliente()->getCelular(),
                        "equipamento_nome" => $os->getEquipamento(),
                        "equipamento_marca" => $os->getMarca(),
                        "equipamento_modelo" => $os->getEquipamento(),
                        "equipamento_serie" => $os->getSerie(),
                        "defeito" => $os->getDiagnostico(),
                        "solucao" => $os->getSolucao(),
                        "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
                        "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
                        "faturamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
                        "ano_atual" => date("Y")
                    ]);
                /*$email->sendEmail(
                    $os->getCliente()->getEmail(),
                    "Faturamento de Serviço - Hyper Computer"
                );*/
            }
            /*if ($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
                $to = $os->getCliente()->getCelular();
                $to = ltrim($to, "0");

                $sms = new SMS();
                $sms->send(
                    $to,
                    "Hyper Computer informa: Ordem de serviço N.º: {$os->getId()} aberta em {$os->getCreatedAt()} para o equipamento {$os->getEquipamento()} foi faturada, aguardando pagamento para retirada."
                );
            }*/
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function payment($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSFaturadas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/payment", count($listaOS), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/payment.php");
    }

    public function paymentDetails($id)
    {
        $os = $this->osRepository->recuperar($id['id']);

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = DateHandler::converterData($updatedAt, "Y-m-d H:i:s", "d/m/Y - H:i");
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $data = [
            "os_id" => $os->getId(),
            "created_at" => DateHandler::converterData($os->getCreatedAt(), "Y-m-d H:i:s", "d/m/Y - H:i"),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_pecas_substituidas" => $os->getPecasSubstituidas(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "valor_peca" => number_format($os->getValorPeca(), 2, ',', '.'),
            "valor_servico" => number_format($os->getValorServico(), 2, ',', '.'),
            "valor_total" => number_format(($os->getValorPeca()+$os->getValorServico()), 2, ',', '.'),
        ];

        echo(ViewController::show("../app/Views/os/payment-details.php", $data));
    }

    public function paymentHandler()
    {
        $payment = json_decode(file_get_contents('php://input'), true);
        
        $os = $this->osRepository->recuperar($payment['id']);

        $os->setEstagio("PAGO");
        $dataAtual = new DateTime();
        $dataFormatada = $dataAtual->format('Y-m-d H:i:s');
        $os->setUpdatedAt($dataFormatada);
        $os->setUpdatedBy(Session::get('user_id'));


        if($this->osRepository->pagarOS(new PagamentoModel($os, (float) $payment['valor-pagamento'], $payment['data-pagamento'], $payment['metodo-pagamento']))) {
            // Adicionar a lógica para envio do orçamento ao cliente neste bloco (via e-mail, sms, WhatsApp, etc...)
            // Disparar notificacao via e-mail com orçamento
            if($os->getCliente()->getPreferenciaContato() >= 2) {
                $email = new Email();

                $email->loadTemplateMessage(
                    "../app/Views/templates/new-pagamento-email.html",
                    [
                        "os_numero" => "OS" . $os->getId() . "N",
                        "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
                        "cliente_nome" => $os->getCliente()->getNome(),
                        "cliente_endereco" => $os->getCliente()->getRua(),
                        "cliente_bairro" => $os->getCliente()->getBairro(),
                        "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
                        "cliente_cep" => $os->getCliente()->getCep(),
                        "cliente_celular" => $os->getCliente()->getCelular(),
                        "equipamento_nome" => $os->getEquipamento(),
                        "equipamento_marca" => $os->getMarca(),
                        "equipamento_modelo" => $os->getEquipamento(),
                        "equipamento_serie" => $os->getSerie(),
                        "defeito" => $os->getDiagnostico(),
                        "solucao" => $os->getSolucao(),
                        "data_pagamento" => date("d/m/Y", strtotime($dataFormatada)),
                        "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
                        "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
                        "faturamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
                        "ano_atual" => date("Y")
                    ]);
                $email->sendEmail(
                    $os->getCliente()->getEmail(),
                    "Pagamento de Serviço - Hyper Computer"
                );
            }
            /*if ($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
                $to = $os->getCliente()->getCelular();
                $to = ltrim($to, "0");

                $sms = new SMS();
                $sms->send(
                    $to,
                    "Hyper Computer informa: Ordem de serviço N.º: {$os->getId()} aberta em {$os->getCreatedAt()} para o equipamento {$os->getEquipamento()} foi paga, equipamento disponível para retirada."
                );
            }*/
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function release($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSPagas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/release", count($listaOS), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/release.php");
    }

    public function releaseDetails($id)
    {
        $os = $this->osRepository->recuperar($id['id']);

        $pagamentoRepository = new PagamentoRepository($this->conn);
        $pagamento = $pagamentoRepository->getPagamentoByOS($os);

        $metodoPagamento = str_replace("-", " ", $pagamento->getMetodoPagamento());
        $metodoPagamento = ucfirst($metodoPagamento);

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = DateHandler::converterData($updatedAt, "Y-m-d H:i:s", "d/m/Y - H:i");
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $data = [
            "os_id" => $os->getId(),
            "created_at" => date("d/m/Y", strtotime($os->getCreatedAt())),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_pecas_substituidas" => $os->getPecasSubstituidas(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "valor_peca" => number_format($os->getValorPeca(), 2, ',', '.'),
            "valor_servico" => number_format($os->getValorServico(), 2, ',', '.'),
            "valor_total" => number_format(($os->getValorPeca()+$os->getValorServico()), 2, ',', '.'),
            "valor_pagamento" => number_format($pagamento->getValor(), 2, ',', '.'),
            "data_pagamento" => date("Y-m-d", strtotime($pagamento->getDataPagamento())),
            "metodo_pagamento" => $metodoPagamento,
        ];
        echo(ViewController::show("../app/Views/os/release-details.php", $data));
    }

    public function releaseHandler()
    {
        $release = json_decode(file_get_contents('php://input'), true);
        //var_dump($release);die;
        $os = $this->osRepository->recuperar($release['id']);

        $dataAtual = new DateTime();
        $dataGarantia = clone $dataAtual;
        $dataGarantia->modify('+90 days');
        $dataAtualFormatada = $dataAtual->format('Y-m-d H:i:s');
        $dataGarantiaFormatada = $dataGarantia->format('Y-m-d H:i:s');

        $os->setEstagio("CONCLUIDO");
        $os->setDataGarantia($dataGarantiaFormatada);
        $os->setUpdatedAt($dataAtualFormatada);
        $os->setUpdatedBy(Session::get('user_id'));

        if($this->osRepository->liberarOS($os)) {
            // Disparar notificacao via e-mail
            if($os->getCliente()->getPreferenciaContato() >= 2) {
                $pdfPath = $this->gerarComprovanteEntregaPDF($os);
                $pdfPath = $this->gerarCertificadoGarantiaPDF($os);

                $email = new Email();

                $email->loadTemplateMessage(
                    "../app/Views/templates/comprovante-entrega-email.html",
                    [
                        "os_numero" => "OS" . $os->getId() . "N",
                        "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
                        "cliente_nome" => $os->getCliente()->getNome(),
                        "cliente_endereco" => $os->getCliente()->getRua(),
                        "cliente_bairro" => $os->getCliente()->getBairro(),
                        "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
                        "cliente_cep" => $os->getCliente()->getCep(),
                        "cliente_celular" => $os->getCliente()->getCelular(),
                        "equipamento_nome" => $os->getEquipamento(),
                        "equipamento_marca" => $os->getMarca(),
                        "equipamento_modelo" => $os->getEquipamento(),
                        "equipamento_serie" => $os->getSerie(),
                        "defeito" => $os->getDiagnostico(),
                        "solucao" => $os->getSolucao(),
                        "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
                        "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
                        "faturamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
                        "recebido_por" => $release['recebido-por'],
                        "liberacao_data" => date("d/m/Y", strtotime($release['data-liberacao'])),
                        "ano_atual" => date("Y")
                    ]);
                $email->sendEmail(
                    $os->getCliente()->getEmail(),
                    "Liberação de Equipamento - Hyper Computer",
                    [$pdfPath]
                );
            }
            /*if ($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
                $to = $os->getCliente()->getCelular();
                $to = ltrim($to, "0");

                $sms = new SMS();
                $sms->send(
                    $to,
                    "Hyper Computer informa: Ordem de serviço N.º: {$os->getId()} aberta em {$os->getCreatedAt()} para o equipamento {$os->getEquipamento()} finalizada em {$os->getUpdatedAt()}. Termo de garantia e comprovante de entrega disponivel via e-mail."
                );
            }*/
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'id' => $os->getId()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }

    public function warranty($id) : void
    {
        $os = $this->osRepository->recuperar($id['id']);
        $path = $this->gerarCertificadoGarantiaPDF($os);
        header("Location: /file/download?path=".$path);
    }

    public function receipt($id) : void
    {
        $os = $this->osRepository->recuperar($id['id']);
        $path = $this->gerarComprovanteEntregaPDF($os);
        header("Location: /file/download?path=".$path);
    }

    public function gerarCertificadoGarantiaPDF(OSModel $os) : string
    {
        $certificadoHTML = $this->gerarCertificadoGarantiaHTML($os);
        $pdf = new GeneratePDF(
            $fonte = 'Arial',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'P',
            $unit = 'mm',
            $size = 'A4'
        );
        $pdfPath = "/docs/os-".$os->getId()."/certificado-garantia.pdf";
        $pdf->convertHtmlToPdf($certificadoHTML, $pdfPath, "Certificado de Garantia", "Termos e condições de garantia para equipamento reparado.");
        return $pdfPath;
    }
    public function gerarComprovanteEntregaPDF(OSModel $os) : string
    {
        $certificadoHTML = $this->gerarComprovanteEntregaHTML($os);
        $pdf = new GeneratePDF(
            $fonte = 'Arial',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'P',
            $unit = 'mm',
            $size = 'A4'
        );
        $pdfPath = "/docs/os-".$os->getId()."/comprovante-entrega.pdf";
        $pdf->convertHtmlToPdf($certificadoHTML, $pdfPath, "Comprovante de Entrega de Equipamento", "Comprovante de devolução do equipamento reparado.");
        return $pdfPath;
    }

    private function gerarCertificadoGarantiaHTML(OSModel $os) {
        $templateFile = "../app/Views/templates/termo-garantia.html";

        $usuarioRepository = new UserRepository($this->conn);
        $usuarioNome = $usuarioRepository->recuperar($os->getUpdatedBy())->getNome();

        $data = [
            "os_numero" => "OS" . $os->getId() . "N",
            "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_endereco" => $os->getCliente()->getRua(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "equipamento_nome" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getEquipamento(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_defeito" => $os->getDiagnostico(),
            "equipamento_solucao" => $os->getSolucao(),
            "equipamento_data_entrega" => date("d/m/Y", strtotime($os->getUpdatedAt())),
            "equipamento_fim_garantia" => date("d/m/Y", strtotime($os->getDataGarantia())),
            "equipamento_acessorios" => $os->getAcessorio(),
            "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
            "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
            "faturamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
            "usuario_nome" => $usuarioNome,
            "ano_atual" => date("Y")
        ];

        try {
            $template = file_get_contents($templateFile);
        } catch (\Exception $e) {
            echo "Erro ao tentar carregar certificado de garantia!";
            throw $e;
        }

        if(!empty($data)) {
            foreach ($data as $key => $value) {
                $template = str_replace('{' . $key . '}', $value, $template);
            }
        }

        return $template;
    }

    public function gerarComprovanteEntregaHTML(OSModel $os)
    {
        $templateFile = "../app/Views/templates/comprovante-entrega.html";

        $usuarioRepository = new UserRepository($this->conn);
        $usuarioNome = $usuarioRepository->recuperar($os->getUpdatedBy())->getNome();
        $data = [
            "os_numero" => "OS" . $os->getId() . "N",
            "os_data" => date("d/m/Y", strtotime($os->getCreatedAt())),
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_endereco" => $os->getCliente()->getRua(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_cidade" => $this->cidadeRepository->recuperar($os->getCliente()->getCidade())->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "equipamento_nome" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getEquipamento(),
            "equipamento_serie" => $os->getSerie(),
            "defeito" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "servico_valor" => number_format(($os->getValorServico()), 2, ',', '.'),
            "pecas_valor" => number_format(($os->getValorPeca()), 2, ',', '.'),
            "faturamento_total" => number_format(($os->getValorServico() + $os->getValorPeca()), 2, ',', '.'),
            "recebido_por" => $usuarioNome,
            "liberacao_data" => date("d/m/Y", strtotime($os->getUpdatedAt())),
            "ano_atual" => date("Y")
        ];

        try {
            $template = file_get_contents($templateFile);
        } catch (\Exception $e) {
            echo "Erro ao tentar carregar comprovante de entrega!";
            throw $e;
        }

        if(!empty($data)) {
            foreach ($data as $key => $value) {
                $template = str_replace('{' . $key . '}', $value, $template);
            }
        }

        return $template;
    }

    public function canceled($get=1)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;

        $listaOS = $this->osRepository->getOSCanceladas();

        for($i=0; $i < count($listaOS); $i++){
            if($listaOS[$i]['n_dias'] <= 1){
                $listaOS[$i]['status'] = "No prazo";
            }
            if($listaOS[$i]['n_dias'] > 1){
                $listaOS[$i]['status'] = "Atrasada";
            }
            if($listaOS[$i]['n_dias'] > 3){
                $listaOS[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($listaOS);
        $pagination = new Pagination("os/canceled", count($listaOS), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($listaOS);
        $navigation = $pagination->getNavigation();

        include("../app/Views/os/canceled.php");
    }

    public function search()
    {
        $action = "search";
        $page = 0;

        include("../app/Views/os/search.php");
    }
    public function searchHandler($search)
    {
        $action = "result";
        isset($search['page']) ? $page = $search['page'] : $page = 1;
        $resultado = null;

        switch($search['searchOption']) {
            case 1:
                $resultado = $this->osRepository->getOSListByID($search['inputSearch']);
                break;
            case 2:
                $resultado = $this->osRepository->getOSListByEquipamento($search['inputSearch']);
                break;
            case 3:
                $resultado = $this->osRepository->getOSListByClienteNome($search['inputSearch']);
                break;
            case 4:
                $input = str_replace(".", "", $search['inputSearch']);
                $input = str_replace("-", "", $input);
                $cpf = substr($input, 0, 3) . '.' . substr($input, 3, 3) . '.' . substr($input, 6, 3) . '-' . substr($input, 9, 2);
                $resultado = $this->osRepository->getOSListByClienteCPF($cpf);
                break;
        }

        for($i=0; $i < count($resultado); $i++) {
            if($resultado[$i]['n_dias'] <= 1){
                $resultado[$i]['status'] = "No prazo";
            }
            if($resultado[$i]['n_dias'] > 1){
                $resultado[$i]['status'] = "Atrasada";
            }
            if($resultado[$i]['n_dias'] > 3){
                $resultado[$i]['status'] = "Parada";
            }
        }

        $qtdResultados = count($resultado);
        $pagination = new Pagination("os/search", count($resultado), 5, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($resultado);
        $navigation = $pagination->getNavigation("inputSearch", $search['inputSearch']);

        include("../app/Views/os/search.php");
    }

    public function show($id)
    {
        $os = $this->osRepository->recuperar($id['id']);
        $estagiosOS = $this->osRepository->getEstagiosOS();

        $updatedAt = $os->getUpdatedAt();
        if ($updatedAt !== "0000-00-00 00:00:00") {
            $updatedAt = date('d/m/Y - H:i', strtotime($updatedAt));
        }

        if($os->getTipo() == "NOVA") {
            $tipoOSNova = "checked";
            $tipoOSGarantia = "";
            $idOSAnterior = "N/A";
        } else {
            $tipoOSNova = "";
            $tipoOSGarantia = "checked";
            $idOSAnterior = $os->getOsAnterior()->getId();
        }

        $preferenciaLigacao = "";
        $preferenciaMensagem = "";

        if($os->getCliente()->getPreferenciaContato() == 1 || $os->getCliente()->getPreferenciaContato() == 3) {
            $preferenciaLigacao = "checked";
        } else if($os->getCliente()->getPreferenciaContato() >= 2) {
            $preferenciaMensagem = "checked";
        }

        $cidade = $this->cidadeRepository->recuperar($os->getCliente()->getCidade());

        $equipamentoCkeckboxSenha = "";
        if($os->getSenha() !== "") $equipamentoCkeckboxSenha = "checked";

        $userCreatedBy = $this->userRepository->recuperar($os->getCreatedBy());

        if(ucwords(strtolower(Session::get('perfil'))) !== "Administrador") $edit_button = "d-none";
        else $edit_button = "";
        $data = [
            "os_id" => $os->getId(),
            "created_at" => date('d/m/Y - H:i', strtotime($os->getCreatedAt())),
            "updated_at" => date('d/m/Y', strtotime($os->getUpdatedAt())),
            "tipo_os_nova" => $tipoOSNova,
            "tipo_os_garantia" => $tipoOSGarantia,
            "id_os_anterior" => $idOSAnterior,
            "cliente_nome" => $os->getCliente()->getNome(),
            "cliente_cpf" => $os->getCliente()->getCPF(),
            "cliente_data_nascimento" => $os->getCliente()->getDataNascimento(),
            "cliente_email" => $os->getCliente()->getEmail(),
            "cliente_rua" => $os->getCliente()->getRua(),
            "cliente_numero" => $os->getCliente()->getNumero(),
            "cliente_complemento" => $os->getCliente()->getComplemento(),
            "cliente_bairro" => $os->getCliente()->getBairro(),
            "cliente_estado" => $cidade->getEstado()->getNome(),
            "cliente_cidade" => $cidade->getNome(),
            "cliente_cep" => $os->getCliente()->getCep(),
            "cliente_celular" => $os->getCliente()->getCelular(),
            "preferencia_ligacao" => $preferenciaLigacao,
            "preferencia_mensagem" => $preferenciaMensagem,
            "equipamento_tipo" => $os->getEquipamento(),
            "equipamento_marca" => $os->getMarca(),
            "equipamento_modelo" => $os->getModelo(),
            "equipamento_serie" => $os->getSerie(),
            "equipamento_checkbox_senha" => $equipamentoCkeckboxSenha,
            "equipamento_senha" => $os->getSenha(),
            "equipamento_acessorio" => $os->getAcessorio(),
            "equipamento_pecas_substituidas" => $os->getPecasSubstituidas(),
            "equipamento_observacao" => $os->getObservacao(),
            "diagnostico" => $os->getDiagnostico(),
            "solucao" => $os->getSolucao(),
            "valor_peca" => number_format($os->getValorPeca(), 2, ',', '.'),
            "valor_servico" => number_format($os->getValorServico(), 2, ',', '.'),
            "valor_total" => number_format(($os->getValorPeca()+$os->getValorServico()), 2, ',', '.'),
            "usuario_nome" => $userCreatedBy->getNome(),
            "cancelamento_status" => ($estagiosOS['CANCELADO'] === "") ? "" : "d-none",
            "canceled_at" => $updatedAt,
            "recebimento_status" => $estagiosOS['CADASTRADO'],
            "diagnostico_status" => $estagiosOS['DIAGNOSTICADO'],
            "orcamento_status" => $estagiosOS['ORCADO'],
            "reparo_status" => $estagiosOS['REPARADO'],
            "faturamento_status" => $estagiosOS['FATURADO'],
            "pagamento_status" => $estagiosOS['PAGO'],
            "liberacao_status" => $estagiosOS['LIBERADO'],
            "finalizacao_status" => $estagiosOS['CONCLUIDO'],
            "edit_button" => $edit_button
        ];
        echo(ViewController::show("../app/Views/os/show.php", $data));
    }
    public function donutDataGenerate($periodo)
    {
        $list = $this->osRepository->getListAllOSByEstagio($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function pizzaDataGenerate($periodo)
    {
        $list = $this->osRepository->getListAllOSByEstagioOrcamento($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function polarDataGenerate($periodo)
    {
        $list = $this->osRepository->getListAllOSByStatus($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function mediaAtendimentoDataGenerate($periodo)
    {
        $list = $this->osRepository->getPrazoMedioAtendimento($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function taxaConclusaoDataGenerate($periodo)
    {
        $list = $this->osRepository->getTaxaConclusao($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function taxaCancelamentoDataGenerate($periodo)
    {
        $list = $this->osRepository->getTaxaCancelamento($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function custoMedioDataGenerate($periodo)
    {
        $list = $this->osRepository->getCustoMedio($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function valorTotalServicos($periodo)
    {
        $list = $this->osRepository->getTotalServicos($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function valorTotalPecas($periodo)
    {
        $list = $this->osRepository->getTotalPecas($periodo['periodo']);
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function ultimosSeisMesesDataGenerate()
    {
        $list = $this->osRepository->getAllOSByCreatedAtLastSixMounths();
        header('Content-Type: application/json');
        echo json_encode($list);
    }

    public function listAllOSByEstagio($periodo)
    {
        $list = $this->osRepository->getListAllOSByEstagio($periodo);

        return $list;
    }

    public function repairCostReport()
    {
        // Caminho para o diretório de destino
        $path = '/reports';

        ArquivoController::clean($path);

        $input = file_get_contents('php://input');

        $periodo = json_decode($input, true);

        $reportData = $this->osRepository->getRepairCostData($periodo);

        if(!$reportData) {
            header('Content-Type: application/json');

            // Retornando um objeto JSON vazio
            echo json_encode([]);
            return;
        }

        $reportData['data_inicial'] = date('d/m/Y', strtotime($periodo['formattedStartDate']));
        $reportData['data_final'] = date('d/m/Y', strtotime($periodo['formattedEndDate']));

        $templateHTML = ViewController::show("../app/Views/templates/reports/relatorio-custo-reparo.html", $reportData);

        $fileName = "relatorio_custo_reparo_(".date('d-m-Y', strtotime($periodo['formattedStartDate']))." a ".date('d-m-Y', strtotime($periodo['formattedEndDate'])).").pdf";
        $pdfPath = $path . "/" . $fileName;

        $pdf = new GeneratePDF(
            $fonte = 'helvetica',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'L',
            $unit = 'mm',
            $size = 'A4'
        );

        $pdf->convertHtmlToPdf(
            $templateHTML,
            $pdfPath,
            "Relatório de Custo de Reparo",
            "Relatório de Custo de Reparo das Ordens de Serviço."
        );

        header('Content-Type: application/json');
        echo json_encode(["filePath" => $path, "fileName" => $fileName]);
    }

    public function technicalPerformanceReport()
    {
        // Caminho para o diretório de destino
        $path = '/reports';

        ArquivoController::clean($path);

        $input = file_get_contents('php://input');

        $periodo = json_decode($input, true);

        $reportData = $this->osRepository->getTechnicalPerformanceData($periodo);

        // Caso não haja dados para o criterio informado, retorna um json vazio
        if(!count($reportData)) {
            header('Content-Type: application/json');

            // Retornando um objeto JSON vazio
            echo json_encode([]);
            return;
        }

        $reportData['tempo_medio_resolucao'] = round($reportData['tempo_medio_resolucao']);
        $reportData['taxa_retrabalho'] = round($reportData['taxa_retrabalho']);
        $reportData['data_inicial'] = date('d/m/Y', strtotime($periodo['formattedStartDate']));
        $reportData['data_final'] = date('d/m/Y', strtotime($periodo['formattedEndDate']));

        $templateHTML = ViewController::show("../app/Views/templates/reports/relatorio-desempenho-tecnico.html", $reportData);

        $fileName = "relatorio-desempenho-tecnico_(".date('d-m-Y', strtotime($periodo['formattedStartDate']))." a ".date('d-m-Y', strtotime($periodo['formattedEndDate'])).").pdf";
        $pdfPath = $path . "/" . $fileName;

        $pdf = new GeneratePDF(
            $fonte = 'helvetica',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'P',
            $unit = 'mm',
            $size = 'A4'
        );

        $pdf->convertHtmlToPdf(
            $templateHTML,
            $pdfPath,
            "Relatório de Desempenho Técnico",
            "Relatório de Desempenho Técnico."
        );

        header('Content-Type: application/json');
        echo json_encode(["filePath" => $path, "fileName" => $fileName]);
    }

    public function statusOSReport()
    {
        // Caminho para o diretório de destino
        $path = '/reports';

        ArquivoController::clean($path);

        $input = file_get_contents('php://input');

        $periodo = json_decode($input, true);

        $reportData = $this->osRepository->getStatusOSReportData($periodo);

        // Caso não haja dados para o criterio informado, retorna um json vazio
        if(!count($reportData)) {
            header('Content-Type: application/json');

            // Retornando um objeto JSON vazio
            echo json_encode([]);
            return;
        }

        $reportData['data_inicial'] = date('d/m/Y', strtotime($periodo['formattedStartDate']));
        $reportData['data_final'] = date('d/m/Y', strtotime($periodo['formattedEndDate']));

        $templateHTML = ViewController::show("../app/Views/templates/reports/relatorio-status-ordens-servico.html", $reportData);

        $fileName = "relatorio-status-ordens-servico_(".date('d-m-Y', strtotime($periodo['formattedStartDate']))." a ".date('d-m-Y', strtotime($periodo['formattedEndDate'])).").pdf";
        $pdfPath = $path . "/" . $fileName;

        $pdf = new GeneratePDF(
            $fonte = 'helvetica',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'P',
            $unit = 'mm',
            $size = 'A4'
        );

        $pdf->convertHtmlToPdf(
            $templateHTML,
            $pdfPath,
            "Relatório de Status das Ordens de Serviço",
            "Relatório de Status das Ordens de Serviço."
        );

        header('Content-Type: application/json');
        echo json_encode(["filePath" => $path, "fileName" => $fileName]);
    }

    public function customerOSReport()
    {
        // Caminho para o diretório de destino
        $path = '/reports';

        ArquivoController::clean($path);

        $input = file_get_contents('php://input');

        $periodo = json_decode($input, true);

        $reportData = $this->osRepository->getCustomerOSReportData($periodo);

        // Caso não haja dados para o criterio informado, retorna um json vazio
        if(!count($reportData)) {
            header('Content-Type: application/json');

            // Retornando um objeto JSON vazio
            echo json_encode([]);
            return;
        }

        $reportData['data_inicial'] = date('d/m/Y', strtotime($periodo['formattedStartDate']));
        $reportData['data_final'] = date('d/m/Y', strtotime($periodo['formattedEndDate']));

        $templateHTML = ViewController::show("../app/Views/templates/reports/relatorio-ordens-servico-por-cliente.html", $reportData);

        $fileName = "relatorio-ordens-servico-por-cliente_(".date('d-m-Y', strtotime($periodo['formattedStartDate']))." a ".date('d-m-Y', strtotime($periodo['formattedEndDate'])).").pdf";
        $pdfPath = $path . "/" . $fileName;

        $pdf = new GeneratePDF(
            $fonte = 'helvetica',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'L',
            $unit = 'mm',
            $size = 'A4'
        );

        $pdf->convertHtmlToPdf(
            $templateHTML,
            $pdfPath,
            "Relatório das Ordens de Serviço por Cliente",
            "Relatório das Ordens de Serviço por Cliente."
        );

        header('Content-Type: application/json');
        echo json_encode(["filePath" => $path, "fileName" => $fileName]);
    }

    public function paymentsReport()
    {
        // Caminho para o diretório de destino
        $path = '/reports';

        ArquivoController::clean($path);

        $input = file_get_contents('php://input');

        $periodo = json_decode($input, true);

        $reportData = $this->osRepository->getPaymentsReportData($periodo);

        // Caso não haja dados para o criterio informado, retorna um json vazio
        if(!count($reportData)) {
            header('Content-Type: application/json');

            // Retornando um objeto JSON vazio
            echo json_encode([]);
            return;
        }

        $reportData['data_inicial'] = date('d/m/Y', strtotime($periodo['formattedStartDate']));
        $reportData['data_final'] = date('d/m/Y', strtotime($periodo['formattedEndDate']));

        $templateHTML = ViewController::show("../app/Views/templates/reports/relatorio-pagamentos.html", $reportData);

        $fileName = "relatorio-pagamentos_(".date('d-m-Y', strtotime($periodo['formattedStartDate']))." a ".date('d-m-Y', strtotime($periodo['formattedEndDate'])).").pdf";
        $pdfPath = $path . "/" . $fileName;

        $pdf = new GeneratePDF(
            $fonte = 'helvetica',
            $estilo = 'B',
            $tamanho = 12,
            $orientation = 'L',
            $unit = 'mm',
            $size = 'A4'
        );

        $pdf->convertHtmlToPdf(
            $templateHTML,
            $pdfPath,
            "Relatório de Pagamentos",
            "Relatório de Pagamentos das Ordens de Serviço."
        );

        header('Content-Type: application/json');
        echo json_encode(["filePath" => $path, "fileName" => $fileName]);
    }

    public function birthdaysReport()
    {
        // Caminho para o diretório de destino
        $path = '/reports';

        ArquivoController::clean($path);

        $input = file_get_contents('php://input');

        $periodo = json_decode($input, true);

        $reportData = $this->osRepository->getBirthdaysReportData($periodo);

        // Caso não haja dados para o criterio informado, retorna um json vazio
        if(!count($reportData)) {
            header('Content-Type: application/json');

            // Retornando um objeto JSON vazio
            echo json_encode([]);
            return;
        }

        $reportData['data_inicial'] = date('d/m/Y', strtotime($periodo['formattedStartDate']));
        $reportData['data_final'] = date('d/m/Y', strtotime($periodo['formattedEndDate']));

        $templateHTML = ViewController::show("../app/Views/templates/reports/relatorio-aniversariantes.html", $reportData);

        $fileName = "relatorio-aniversariantes_(".date('d-m-Y', strtotime($periodo['formattedStartDate']))." a ".date('d-m-Y', strtotime($periodo['formattedEndDate'])).").pdf";
        $pdfPath = $path . "/" . $fileName;

        $pdf = new GeneratePDF(
            $fonte = 'helvetica',
            $estilo = 'B',
            $tamanho = 8,
            $orientation = 'L',
            $unit = 'mm',
            $size = 'A4'
        );

        $pdf->convertHtmlToPdf(
            $templateHTML,
            $pdfPath,
            "Relatório de Aniversariantes",
            "Relatório de Clientes que fazem aniversario dentro do periodo informado."
        );

        header('Content-Type: application/json');
        echo json_encode(["filePath" => $path, "fileName" => $fileName]);
    }
}