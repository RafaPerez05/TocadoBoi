<?php
class JsonToCsvAdapter {
    private $jsonData;

    public function __construct($jsonData) {
        $this->jsonData = $jsonData;
    }

    public function convertToCsv() {
        // Decodifica o JSON para um array associativo
        $data = json_decode($this->jsonData, true);

        if (empty($data) || !is_array($data)) {
            throw new Exception('Dados JSON inválidos ou vazios.');
        }

        // Abre o buffer de escrita
        $output = fopen('php://temp', 'r+');

        // Adiciona os cabeçalhos
        $headers = array_keys($data[0]);
        fputcsv($output, $headers);

        // Adiciona os dados
        foreach ($data as $row) {
            fputcsv($output, $row);
        }

        // Move o ponteiro para o início do buffer
        rewind($output);

        // Lê o conteúdo do buffer
        $csvData = stream_get_contents($output);
        fclose($output);

        return $csvData;
    }

    public function saveCsvToFile() {

        $filePath =  __DIR__ . '/JSON/relatorio_vendas.csv';
        $csvData = $this->convertToCsv();

        // Salva o CSV em um arquivo
        file_put_contents($filePath, $csvData);
    }
}
