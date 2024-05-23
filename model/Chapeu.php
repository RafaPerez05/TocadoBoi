<?php
require_once "Produto.php";

class Chapeu extends Produto {
    private $estilo;
    private $circunferencia;

    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tamanho, $material, $tipo, $estilo, $circunferencia) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tamanho, $material, $tipo);
        $this->estilo = $estilo;
        $this->circunferencia = $circunferencia;
    }

    // Métodos getters e setters para os atributos específicos
    public function getEstilo() {
        return $this->estilo;
    }

    public function setEstilo($estilo) {
        $this->estilo = $estilo;
    }

    public function getCircunferencia() {
        return $this->circunferencia;
    }

    public function setCircunferencia($circunferencia) {
        $this->circunferencia = $circunferencia;
    }
}