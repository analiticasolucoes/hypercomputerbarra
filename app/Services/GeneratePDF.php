<?php

namespace App\Services;

use App\Src\TCPDF\tcpdf;

class GeneratePDF extends TCPDF {
    private string $fonte;
    private string $estilo;
    private int $tamanho;

    private $cabecalho;
    private $tabela;
    private $resumo;
    private $analise;
    private $conclusao;

    public function __construct(
        $fonte = 'helvetica',
        $estilo = 'B',
        $tamanho = 12,
        $orientation = 'L',
        $unit = 'mm',
        $size = 'A4'
    ) {
        $this->fonte = $fonte;
        $this->estilo = $estilo;
        $this->tamanho = $tamanho;
        parent::__construct($orientation, $unit, $size);
    }

    public function setCabecalho($cabecalho) {
        $this->cabecalho = $cabecalho;
    }

    public function setTabela($tabela) {
        $this->tabela = $tabela;
    }

    public function setResumo($resumo) {
        $this->resumo = $resumo;
    }

    public function setAnalise($analise) {
        $this->analise = $analise;
    }

    public function setConclusao($conclusao) {
        $this->conclusao = $conclusao;
    }

    public function createPDF() {
        $this->AddPage();
        $this->SetFont($this->fonte, $this->estilo, $this->tamanho);
        $this->addHeader();
        $this->Ln(10);
        $this->addTable();
        $this->Ln(10);
        $this->addSummary();
        $this->Ln(10);
        $this->addAnalysis();
        $this->Ln(10);
        $this->addConclusion();
    }

    private function addHeader() {
        $header = $this->cabecalho;
        foreach ($header as $row) {
            $this->Cell(0, 10, $row, 0, 1, 'C');
        }
    }

    private function addTable() {
        $tabela = $this->tabela;
        $cabecalho = array_shift($tabela);

        // Armazena os nomes das colunas da tabela
        $colunas = array_keys($cabecalho);

        // Define a fonte e estilo para o cabeçalho
        $this->SetFont($this->fonte, $this->estilo, 10);

        // Armazena as larguras das colunas definidas no cabeçalho
        $larguras = array_values($cabecalho);

        // Imprime os cabecalhos da tabela
        foreach ($colunas as $index => $coluna) {
            $this->Cell($larguras[$index], 10, $coluna, 1, 0, 'C');
        }
        $this->Ln();

        // Define a fonte e estilo para as linhas da tabela
        $this->SetFont($this->fonte, '', 10);

        // Imprime as linhas da tabela
        foreach ($tabela as $linha) {
            $index = 0;
            foreach ($linha as $value) {
                $this->Cell($larguras[$index], 10, $value, 1, 0, 'C');
                $index++;
            }
            $this->Ln();
        }
    }

    private function addSummary() {
        $resumo = $this->resumo;

        $this->SetFont($this->fonte, 'B', 12);
        $this->Cell(0, 10, "Resumo:", 0, 1, 'L');

        $this->SetFont($this->fonte, '', 12);
        foreach ($resumo as $texto => $valor) {
            $this->Cell(0, 7, $texto . $valor, 0, 1, 'L');
        }
    }

    private function addAnalysis() {
        $analise = $this->analise;

        $this->SetFont($this->fonte, 'B', 12);
        $this->Cell(0, 10, 'Análise:', 0, 1, 'L');

        $this->SetFont($this->fonte, '', 12);
        foreach ($analise as $texto => $valor) {
            $this->MultiCell(0, 7, $texto . $valor, 0, 'L', false);
        }
    }

    private function addConclusion() {
        $conclusao = $this->conclusao;

        $this->SetFont($this->fonte, 'B', 12);
        $this->Cell(0, 10, 'Conclusões:', 0, 1, 'L');

        $this->SetFont($this->fonte, '', 12);
        foreach ($conclusao as $linha) {
            $this->MultiCell(0, 7, $linha, 0, 'L', false);
        }
    }

    public function savePDF($nomeArquivo, $dest = 'F') {
        // Caminho absoluto para o diretório de destino
        $path = realpath(__DIR__ . '/..') . '/reports/';
    
        // Verifica se o diretório de destino existe; se não, tenta criar
        if (!file_exists($path) && !mkdir($path, 0777, true)) {
            // Tratamento de erro, por exemplo:
            throw new \Exception('Falha ao criar diretório de relatórios.');
        }
    
        // Caminho completo para o arquivo
        $arquivo = $path . $nomeArquivo;
    
        // Gera o PDF
        $this->Output($arquivo, $dest);
    
        // Verifica se o arquivo foi criado com sucesso
        if (!file_exists($arquivo)) {
            // Tratamento de erro, por exemplo:
            throw new \Exception('Falha ao salvar o arquivo PDF.');
        }
    
        return $arquivo; // Retorna o caminho completo para o arquivo salvo
    }

    public function convertHtmlToPdf($htmlContent, $outputPath, $titulo="", $assunto="") {
        $path = dirname(__DIR__) . $outputPath;

        // Define as informações do documento
        self::SetCreator(PDF_CREATOR);
        self::SetAuthor('Hyper Computer');
        self::SetTitle($titulo);
        self::SetSubject($assunto);

        // Define as margens do documento
        self::SetMargins(5, 5, 5);
        self::SetHeaderMargin(PDF_MARGIN_HEADER);
        self::SetFooterMargin(PDF_MARGIN_FOOTER);

        // Define a quebra automática de páginas
        self::SetAutoPageBreak(TRUE, 5);

        // Define o formato do cabeçalho e rodapé
        self::setPrintHeader(false);
        self::setPrintFooter(false);

        // Adiciona uma página
        self::AddPage();

        // Define o conteúdo HTML
        self::writeHTML($htmlContent, true, false, true, false, '');

        // Verifica se o diretório de destino existe; se não, tenta criar
        if (!file_exists(dirname($path)) && !mkdir(dirname($path), 0777, true)) {
            // Tratamento de erro, por exemplo:
            throw new \Exception('Falha ao criar diretório de relatórios.');
        }

        // Saída do documento PDF
        self::Output($path, 'F');
    }
}