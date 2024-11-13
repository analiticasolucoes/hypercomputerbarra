<?php
require_once '../app/models/ArquivoModel.php';

class ArquivoRepository {

    private $db;
    private ArquivoModel $arquivo;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getArquivo() {
        return $this->arquivo;
    }

    public function incluir(ArquivoModel $arquivo) : bool {
        $parametros = [
            'topico_id' => $arquivo->getTopicoId(),
            'nome' => $arquivo->getNome(),
            'caminho' => $arquivo->getCaminho(),
            'tipo' => $arquivo->getTipo(),
            'tamanho' => $arquivo->getTamanho()
        ];

        if($this->db->inserir("arquivos", $parametros)) {
            $arquivo->setId($this->db->getLastInsertId());
            $this->arquivo = $arquivo;
            return true;
        }
        return false;
    }

    public function recuperar($id) : ArquivoModel {
        $query = "SELECT * FROM arquivos WHERE id = :id";
        $parametros = ['id' => $id];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) > 0) {
            $registro = $resultado[0];
            $arquivo = new ArquivoModel();
            $arquivo->setId($registro['id']);
            $arquivo->setTopicoId($registro['topico_id']);
            $arquivo->setNome($registro['nome']);
            $arquivo->setCaminho($registro['caminho']);
            $arquivo->setTipo($registro['tipo']);
            $arquivo->setTamanho($registro['tamanho']);

            return $arquivo;
        } else {
            throw new Exception("Nenhum arquivo encontrado com o ID fornecido.");
        }
    }

    public function atualizar(ArquivoModel $arquivo) : bool {
        try {
            $dados = [
                'topico_id' => $arquivo->getTopicoId(),
                'nome' => $arquivo->getNome(),
                'caminho' => $arquivo->getCaminho(),
                'tipo' => $arquivo->getTipo(),
                'tamanho' => $arquivo->getTamanho()
            ];
            
            $condicao = [
                "id" => $arquivo->getId()
            ];

            return $this->db->atualizar('arquivos', $dados, $condicao) ? true : false;
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar arquivo: " . $e->getMessage());
        }
    }

    public function excluir(ArquivoModel $arquivo) : bool {
        if(!$this->removeFile($arquivo)) return false;

        $condicao = [
            "id" => $arquivo->getId()
        ];
        $parametros = ['id' => $arquivo->getId()];
        return $this->db->excluir('arquivos', $condicao, $parametros) ? true : false;
    }

    public function getAllArquivosByTopic(TopicModel $topico) {
        $query = "SELECT * FROM arquivos WHERE topico_id = :topico_id";
        $parametros = ['topico_id' => $topico->getId()];
        $resultado = $this->db->consultar($query, $parametros);

        if (count($resultado) > 0) {
            return $this->generateArquivosList($resultado);
        } else {
            return null;
        }
    }

    private function removeDirectory($dir) : bool {
        if (!is_dir($dir)) {
            return false;
        }
        
        $items = array_diff(scandir($dir), array('.', '..'));
        
        foreach ($items as $item) {
            $path = $dir . DIRECTORY_SEPARATOR . $item;
            
            if (is_dir($path)) {
                $this->removeDirectory($path);
            } else {
                unlink($path);
            }
        }
        
        return rmdir($dir);
    }
    
    private function removeFile(ArquivoModel $arquivo) : bool {

        if (!file_exists($arquivo->getCaminho())) {
            return false;
        }
        
        if(!unlink($arquivo->getCaminho())) return false;

        @rmdir($arquivo->getCaminho());

        return true;
    }

    private function generateArquivosList ($arquivosList) {
        $arquivoModel = null;

        foreach($arquivosList as $arquivo){
            $arquivoModel = new ArquivoModel();
            $arquivoModel->setId($arquivo['id']);
            $arquivoModel->setTopicoId($arquivo['topico_id']);
            $arquivoModel->setNome($arquivo['nome']);
            $arquivoModel->setCaminho($arquivo['caminho']);
            $arquivoModel->setTipo($arquivo['tipo']);
            $arquivoModel->setTamanho($arquivo['tamanho']);

            $arquivos[] = $arquivoModel;
        }
        return $arquivos;
    }
}

?>