<?php
require_once "Produto.php";

class Camisa extends Produto {
    private $modelo;
    private $cor;

    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tamanho, $material, $tipo, $modelo, $cor) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tamanho, $material, $tipo);
        $this->modelo = $modelo;
        $this->cor = $cor;
    }

    // Métodos getters e setters para os atributos específicos
    public function getModelo() {
        return $this->modelo;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function getCor() {
        return $this->cor;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }
}