<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\PessoaFisicaModel;
use App\Repositories\ClienteRepository;
use App\Repositories\CidadeRepository;
use App\Repositories\OSRepository;
use App\Services\Pagination;
use DateTime;

class ClienteController
{
    private ClienteModel $clienteModel;
    private ClienteRepository $clienteRepository;
    private CidadeRepository $cidadeRepository;
    private OSRepository $osRepository;

    public function __construct($conn)
    {
        $this->clienteModel = new ClienteModel();
        $this->clienteRepository = new ClienteRepository($conn);
        $this->cidadeRepository = new CidadeRepository($conn);
        $this->osRepository = new OSRepository($conn);
    }

    public function index()
    {
        include '../app/Views/client/add.php';
    }

    public function addHandler()
    {
        $cliente = json_decode(file_get_contents('php://input'), true);

        $dateTime = DateTime::createFromFormat('d/m/Y', $cliente['data-nascimento']);
        $dataNascimento = $dateTime->format('Y-m-d');
        $celular = $this->sanitizarNumeroCelular($cliente['celular']);
        $cep = preg_replace('/\D/', '', $cliente['cep']);
        $cpf = preg_replace('/\D/', '', $cliente['cpf']);
        $cpf = str_replace(".", "", $cpf);
        $cpf = str_replace("-", "", $cpf);

        $clientePF = new PessoaFisicaModel(
            0,
            $cliente['email'],
            $celular,
            0,
            strtoupper($cliente['rua']),
            strtoupper($cliente['numero']),
            strtoupper($cliente['bairro']),
            strtoupper($cliente['complemento']),
            $cliente['cidade'],
            $cep,
            strtoupper($cliente['nome']),
            $cpf,
            $dataNascimento
        );
    
        // Configurar preferência de contato
        $preferenciaContato = 0;
        if(isset($cliente['ligacao'])) $preferenciaContato += 1;
        if(isset($cliente['mensagem'])) $preferenciaContato += 2;
        $clientePF->setPreferenciaContato($preferenciaContato);

        if($this->clienteRepository->incluir($clientePF)) {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'cliente' => $this->clienteRepository->getCliente()
            ], JSON_PRETTY_PRINT);
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
            ]);
        }
    }
    
    public function show($id)
    {
        $cliente = $this->clienteRepository->recuperar($id['id']);
        if($cliente) {
            $cidade = $this->cidadeRepository->recuperar($cliente->getCidade());
            $osList = $this->osRepository->getOSListByClienteID($cliente->getId());
            for($i=0; $i < count($osList); $i++){
                if($osList[$i]['n_dias'] <= 1){
                    $osList[$i]['status'] = "No prazo";
                }
                if($osList[$i]['n_dias'] > 1){
                    $osList[$i]['status'] = "Atrasada";
                }
                if($osList[$i]['n_dias'] > 3){
                    $osList[$i]['status'] = "Parada";
                }
            }
            include("../app/Views/client/show.php");
        } else {
            ViewController::render(
                "error",
                "Detalhe - Cliente",
                "Não foi possível exibir os detalhes do Cliente...!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                ["error" => "ID do cliente informado não foi localizado."]
            );
        }
    }

    public function edit($cliente)
    {
        $clienteToEdit = $this->clienteRepository->recuperar($cliente['id']);
        $cidade = $this->cidadeRepository->recuperar($clienteToEdit->getCidade());
        include("../app/Views/client/edit.php");
    }

    public function editHandler($cliente)
    {
        $clienteToUpdate = $this->clienteRepository->recuperar($cliente['id']);

        $clienteToUpdate->setNome($cliente['nome']);
        $clienteToUpdate->setCpf($cliente['cpf']);
        $clienteToUpdate->setDataNascimento($cliente['data-nascimento']);
        $clienteToUpdate->setEmail($cliente['email']);
        $clienteToUpdate->setCelular($cliente['celular']);

        $preferenciaContato = 0;
        if(isset($cliente['ligacao'])) $preferenciaContato += 1;
        if(isset($cliente['mensagem'])) $preferenciaContato += 2;
        $clienteToUpdate->setPreferenciaContato($preferenciaContato);
        
        $clienteToUpdate->setRua($cliente['rua']);
        $clienteToUpdate->setNumero($cliente['numero']);
        $clienteToUpdate->setBairro($cliente['bairro']);
        $clienteToUpdate->setComplemento($cliente['complemento']);
        $clienteToUpdate->setCidade($cliente['cidade']);
        $clienteToUpdate->setCep($cliente['cep']);
        
        $resultado = $this->clienteRepository->atualizar($clienteToUpdate);

        if($resultado) {
            ViewController::render(
                "sucess",
                "Alteração - Cliente",
                "Cliente alterado com sucesso!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                []
            );
        } else {
            ViewController::render(
                "error",
                "Alteração - Cliente",
                "Não foi possível alterar o cliente...!",
                "/user/dashboard",
                "Voltar para Tela Inicial",
                ["error" => ""]
            );
        }
    }
    
    public function search()
    {
        $action = "search";
        $page = 0;
        include("../app/Views/client/search.php");
    }

    public function searchHandler($search)
    {
        $action = "result";
        isset($search['page']) ? $page = $search['page'] : $page = 1;
        $resultado = null;

        switch($search['searchOption']) {
            case 1:
                $resultado = $this->getClienteByNome($search['inputSearch']);
                break;
            case 2:
                $input = str_replace(".", "", $search['inputSearch']);
                $input = str_replace("-", "", $input);
                //$cpf = substr($input, 0, 3) . '.' . substr($input, 3, 3) . '.' . substr($input, 6, 3) . '-' . substr($input, 9, 2);
                $resultado = $this->getClienteByCPF($input);
                break;
        }

        $qtdResultados = count($resultado);
        $pagination = new Pagination("client/search", count($resultado), 10, $page);
        $resultadoPaginado = $pagination->getPaginatedItems($resultado);
        $navigation = $pagination->getNavigation("inputSearch", $search['inputSearch']);
        include("../app/Views/client/search.php");
    }

    public function searchClienteJSon($busca)
    {
        // Verifica se foi fornecido o parâmetro 'nome' na busca
        if (isset($busca['nome'])) {
            return $this->clienteRepository->generateClientsListJSon($this->getClienteByNome($busca['nome']));
        }
        // Verifica se foi fornecido o parâmetro 'cpf' na busca
        elseif (isset($busca['cpf'])) {
            return $this->clienteRepository->generateClientsListJSon($this->getClienteByCPF($busca['cpf']));
        }
        // Verifica se foi fornecido o parâmetro 'id' na busca
        elseif (isset($busca['id'])) {
            return $this->clienteRepository->generateClientsListJSon($this->getClienteById($busca['id']));
        }
        // Verifica se foi fornecido o parâmetro 'id' na busca
        elseif (isset($busca['email'])) {
            return $this->clienteRepository->generateClientsListJSon($this->getClienteByEmail($busca['email']));
        }
        // Se nenhum critério de busca válido foi fornecido, retorna null
        else {
            return null;
        }
    }

    public function getClienteByNome($nome)
    {
        return $this->clienteRepository->getClienteByNome($nome);
    }
    
    public function getClienteByCPF($cpf)
    {
        return $this->clienteRepository->getClienteByCPF($cpf);
    }
    
    public function getClienteById($id)
    {
        return $this->clienteRepository->getClienteById($id);
    }

    public function getClienteByEmail($email)
    {
        return $this->clienteRepository->getClienteByEmail($email);
    }
    private function sanitizarNumeroCelular($numero)
    {
        // Remove todos os caracteres que não são números
        $numeros_puros = preg_replace('/\D/', '', $numero);
        
        // Opcional: Formatar o número de celular (exemplo para números brasileiros)
        // Este exemplo assume um formato de número brasileiro: (XX) XXXXX-XXXX
        if (strlen($numeros_puros) == 11) {
            $numero_formatado = preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $numeros_puros);
        } elseif (strlen($numeros_puros) == 10) {
            // Formato alternativo: (XX) XXXX-XXXX
            $numero_formatado = preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $numeros_puros);
        } else {
            // Se o número não tiver 10 ou 11 dígitos, retorná-lo sem formatação adicional
            $numero_formatado = $numeros_puros;
        }
    
        return $numero_formatado;
    }
}