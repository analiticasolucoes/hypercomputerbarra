<?php

namespace App\Repositories;

use App\Models\ClienteModel;
use App\Models\PessoaFisicaModel;
use App\Models\PessoaJuridicaModel;
use App\Services\DateHandler;
use Exception;
use DateTime;

class ClienteRepository
{
    private $db;
    private ClienteModel $cliente;

    public function __construct($db) {
        $this->db = $db;
    }

    public function incluir($cliente) : bool {
        $parametros = [
            'tipo' => $cliente->getTipo(),
            'email' => strtolower($cliente->getEmail()),
            'celular' => $cliente->getCelular(),
            'preferencia_contato' => $cliente->getPreferenciaContato(),
            'rua' => strtoupper($cliente->getRua()),
            'numero' => strtoupper($cliente->getNumero()),
            'bairro' => strtoupper($cliente->getBairro()),
            'complemento' => strtoupper($cliente->getComplemento()),
            'cidade' => $cliente->getCidade(),
            'cep' => $cliente->getCep()
        ];

        try {
            $this->db->inserir("cliente", $parametros);
        } catch (Exception $e) {
            throw new Exception("Erro ao tentar incluir novo cliente.");
        }

        $cliente->setId($this->db->getLastInsertId());

        if ($cliente instanceof PessoaFisicaModel) {
            $parametrosPF = [
                'id' => $cliente->getId(),
                'nome' => strtoupper($cliente->getNome()),
                'cpf' => $cliente->getCpf(),
                'data_nascimento' => $cliente->getDataNascimento()
            ];

            try {
                $this->db->inserir("pessoa_fisica", $parametrosPF);    
            } catch (Exception $e) {
                throw new Exception("Erro ao tentar incluir novo cliente Pessoa Física.");
            }
        } elseif ($cliente instanceof PessoaJuridicaModel) {
            $parametrosPJ = [
                'id' => $cliente->getId(),
                'cnpj' => $cliente->getCnpj(),
                'razao_social' => $cliente->getRazaoSocial(),
                'inscricao_estadual' => $cliente->getInscricaoEstadual()
            ];
            try {
                $this->db->inserir("pessoa_juridica", $parametrosPJ);    
            } catch (Exception $e) {
                throw new Exception("Erro ao tentar incluir novo cliente Pessoa Jurídica.");
            }
        } else {
            // Cliente não reconhecido
            return false;
        }
        $this->cliente = $cliente;
        return true;
    }

    public function getCliente(): ClienteModel
    {
        return $this->cliente;
    }

    public function recuperar($id) {
        $query = 
        "SELECT c.*, pf.nome AS nome, pf.cpf, pf.data_nascimento, pj.cnpj, pj.razao_social, pj.nome_fantasia, pj.inscricao_estadual
        FROM cliente c
        LEFT JOIN pessoa_fisica pf ON c.id = pf.id
        LEFT JOIN pessoa_juridica pj ON c.id = pj.id
        WHERE c.id = :id";

        try {
            $parametros = ['id' => $id];
            $resultado = $this->db->consultar($query, $parametros);
    
            if (count($resultado) == 1) {
                return $this->generateCliente($resultado[0]);
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw new Exception("Nenhum cliente encontrado com o ID fornecido.");
        }
    }    

    public function atualizar(ClienteModel $cliente) : bool {
        
        $resultado = false;
        try {
            $condicao = ["id" => $cliente->getId()];

            $dadosCliente = [
                'email' => $cliente->getEmail(),
                'celular' => $cliente->getCelular(),
                'preferencia_contato' => $cliente->getPreferenciaContato(),
                'rua' => $cliente->getRua(),
                'numero' => $cliente->getNumero(),
                'bairro' => $cliente->getBairro(),
                'complemento' => $cliente->getComplemento(),
                'cidade' => $cliente->getCidade(),
                'cep' => $cliente->getCep()
            ];
    
            if ($cliente instanceof PessoaFisicaModel) {
                $dateTime = DateTime::createFromFormat('d/m/Y', $cliente->getDataNascimento());
                $dadosPF = [
                    'nome' => $cliente->getNome(),
                    'cpf' => $cliente->getCpf(),
                    'data_nascimento' => $dateTime->format("Y-m-d")
                ];
                $resultado = $this->db->atualizar('pessoa_fisica', $dadosPF, $condicao);
            } elseif ($cliente instanceof PessoaJuridicaModel) {
                $dadosPJ = [
                    'razao_social' => $cliente->getRazaoSocial(),
                    'cnpj' => $cliente->getCnpj(),
                    'inscricao_estadual' => $cliente->getInscricaoEstadual()
                ];
                $resultado = $this->db->atualizar('pessoa_juridica', $dadosPJ, $condicao);
            }

            if(!$resultado) return false;

            $resultado = $this->db->atualizar('cliente', $dadosCliente, $condicao);

            return $resultado;
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar cliente: " . $e->getMessage());
        }
    }
    
    public function excluir(ClienteModel $cliente) : bool {
        try {
            $condicao = "id = :id";
            $parametros = ['id' => $cliente->getId()];
            return $this->db->excluir('cliente', $condicao, $parametros) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao excluir cliente: " . $e->getMessage());
        }
    }    

    public function getClienteByNome($nome)
    {
        $query = 
        "SELECT c.*, pf.nome AS nome, pf.cpf, pf.data_nascimento
        FROM cliente c
        JOIN pessoa_fisica pf ON c.id = pf.id
        WHERE pf.nome LIKE CONCAT('%', :nome, '%')
        ORDER BY nome ASC;";
        $parametros = ['nome' => $nome];
        
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            return $this->generateClientsList($resultado);
        } else {
            return $this->generateClientsList([]);
        }
    }

    public function getClienteByCPF($cpf) {
        $query = 
        "SELECT c.*, pf.nome AS nome, pf.cpf, pf.data_nascimento
        FROM cliente c
        JOIN pessoa_fisica pf ON c.id = pf.id
        WHERE pf.cpf LIKE CONCAT('%', :cpf, '%');";
        $parametros = ['cpf' => $cpf];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            return $this->generateClientsList($resultado);
        } else {
            return $this->generateClientsList([]);
        }
    }

    public function getClienteById($id) {
        $query = 
        "SELECT c.*, pf.nome AS nome, pf.cpf, pf.data_nascimento
        FROM cliente c
        JOIN pessoa_fisica pf ON c.id = pf.id
        WHERE c.id = :id";

        $parametros = ['id' => $id];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            return $this->generateClientsList($resultado);
        } else {
            return $this->generateClientsList([]);
        }
    }

    public function getClienteByEmail($email) {
        $query =
        "SELECT c.*, pf.nome AS nome, pf.cpf, pf.data_nascimento
        FROM cliente c
        JOIN pessoa_fisica pf ON c.id = pf.id
        WHERE pf.cpf LIKE CONCAT('%', :email, '%');";
        $parametros = ['email' => $email];
        $resultado = $this->db->consultar($query, $parametros);

        if ($resultado) {
            return $this->generateClientsList($resultado);
        } else {
            return $this->generateClientsList([]);
        }
    }

    private function generateClientsList($clienteList) {
        $clientes = [];
        foreach($clienteList as $cliente){
            $clientes[] = $this->generateCliente($cliente);
        }
        return $clientes;
    }

    public function all() : array
    {
        $query =
        "SELECT
            c.*, pf.nome AS nome, pf.cpf, pf.data_nascimento
        FROM
            cliente c
        JOIN
            pessoa_fisica pf ON c.id = pf.id";

        $resultado = $this->db->consultar($query, []);

        if ($resultado) {
            return $this->generateClientsList($resultado);
        } else {
            return $this->generateClientsList([]);
        }
    }

    public function generateClientsListJSon($clientList) {
        header('Content-Type: application/json');
        echo json_encode($clientList, JSON_PRETTY_PRINT);
    }

    private function generateCliente($clienteReg) {
        
        if ($clienteReg['tipo'] === "PF") { // Pessoa Física
            $dateTime = DateTime::createFromFormat('Y-m-d', $clienteReg['data_nascimento']);
            $dataNascimento = $dateTime->format('d/m/Y');
            $cpfCliente = str_replace(".", "", $clienteReg['cpf']);
            $cpfCliente = str_replace("-", "", $cpfCliente);
            $cpf = substr($cpfCliente, 0, 3) . '.' . substr($cpfCliente, 3, 3) . '.' . substr($cpfCliente, 6, 3) . '-' . substr($cpfCliente, 9, 2);

            $cliente = new PessoaFisicaModel(
                $clienteReg['id'],
                strtolower($clienteReg['email']),
                $clienteReg['celular'], 
                $clienteReg['preferencia_contato'],
                strtoupper($clienteReg['rua']),
                strtoupper($clienteReg['numero']),
                strtoupper($clienteReg['bairro']),
                strtoupper($clienteReg['complemento']),
                $clienteReg['cidade'], 
                $clienteReg['cep'],
                strtoupper($clienteReg['nome']),
                $cpf,
                $dataNascimento
            );
        } else { // Pessoa Jurídica
            $cliente = new PessoaJuridicaModel(
                $clienteReg['id'],
                $clienteReg['email'],
                $clienteReg['celular'], 
                $clienteReg['preferencia_contato'],
                $clienteReg['rua'], 
                $clienteReg['numero'], 
                $clienteReg['bairro'],
                $clienteReg['complemento'],
                $clienteReg['cidade'], 
                $clienteReg['cep'],
                $clienteReg['cnpj'],
                $clienteReg['razao_social'],
                $clienteReg['nome_fantasia'],
                $clienteReg['inscricao_estadual']
            );
        }
        // Retornar o cliente
        return $cliente;
    }
}