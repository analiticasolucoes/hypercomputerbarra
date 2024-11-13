<?php

namespace App\Core;

use PDO;
use PDOException;
use Exception;

class Database 
{
    private static $instance = null;
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $connection;

    private function __construct($host, $dbname, $username, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;

        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance($host, $dbname, $username, $password) {
        if (!self::$instance) {
            self::$instance = new self($host, $dbname, $username, $password);
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    private function getAtributo($atributoNome) {
        switch ($atributoNome) {
            case 'host':
                return $this->host;
            case 'dbname':
                return $this->dbname;
            case 'username':
                return $this->username;
            case 'password':
                return $this->password;
            default:
                return null;
        }
    }

    public function inserir($tabela, $dados): bool {
        try {
            $campos = implode(', ', array_keys($dados));
            $valores = ':' . implode(', :', array_keys($dados));

            $query = "INSERT INTO $tabela ($campos) VALUES ($valores)";
            $stmt = $this->connection->prepare($query);
            
            return $stmt->execute($dados);
        } catch (PDOException $e) {
            throw new Exception("Erro ao inserir registro: " . $e->getMessage());
        }
    }

    public function getLastInsertId(): int {
        return $this->connection->lastInsertId();
    }

    public function atualizar($tabela, $dados, $condicoes): bool {
        $campos = '';
        foreach ($dados as $campo => $valor) {
            $campos .= "$campo = :$campo, ";
        }
        $campos = rtrim($campos, ', ');

        $condicoes_str = '';
        foreach ($condicoes as $condicao => $valor) {
            $condicoes_str .= "$condicao = :$condicao AND ";
        }
        $condicoes_str = rtrim($condicoes_str, ' AND ');

        $query = "UPDATE $tabela SET $campos WHERE $condicoes_str";

        try {
            $stmt = $this->connection->prepare($query);
            foreach ($dados as $campo => $valor) {
                $stmt->bindValue(":$campo", $valor);
            }
            foreach ($condicoes as $condicao => $valor) {
                $stmt->bindValue(":$condicao", $valor);
            }
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar registro: " . $e->getMessage());
        }
    }

    public function excluir($tabela, $condicoes): int {
        $condicoes_str = '';
        foreach ($condicoes as $condicao => $valor) {
            $condicoes_str .= "$condicao = :$condicao AND ";
        }
        $condicoes_str = rtrim($condicoes_str, ' AND ');

        try {
            $query = "DELETE FROM $tabela WHERE $condicoes_str";
            $stmt = $this->connection->prepare($query);
            foreach ($condicoes as $condicao => $valor) {
                $stmt->bindValue(":$condicao", $valor);
            }
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception("Erro ao excluir registro: " . $e->getMessage());
        }
    }

    public function consultar($query, $parametros) {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($parametros);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao executar consulta: " . $e->getMessage());
        }
    }
    
    public function consultarPorAtributo($query, $atributoNome) {
        $valorAtributo = $this->getAtributo($atributoNome);
        if ($valorAtributo === null) {
            throw new Exception("Atributo {$atributoNome} não encontrado.");
        }

        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute([':valor' => $valorAtributo]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao executar consulta: " . $e->getMessage());
        }
    }
}