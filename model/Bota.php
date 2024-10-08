<?php
require_once "Produto.php";

class Bota extends Produto {
    private $alturaCano;

    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material, $alturaCano) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material);
        $this->alturaCano = $alturaCano;
    }

    // Métodos getters e setters para os atributos específicos
    public function getAlturaCano() {
        return $this->alturaCano;
    }

    public function setAlturaCano($alturaCano) {
        $this->alturaCano = $alturaCano;
    }
}