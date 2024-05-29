<?php
require_once "Produto.php";

class Cinto extends Produto {
    private $largura;
    private $materialFivela;

    // Construtor
    public function __construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material, $largura, $materialFivela) {
        parent::__construct($nome, $fabricante, $descricao, $valor, $imagem, $sexo, $tipo, $tamanho, $material,);
        $this->largura = $largura;
        $this->materialFivela = $materialFivela;
    }

    // Métodos getters e setters para os atributos específicos
    public function getLargura() {
        return $this->largura;
    }

    public function setLargura($largura) {
        $this->largura = $largura;
    }

    public function getMaterialFivela() {
        return $this->materialFivela;
    }

    public function setMaterialFivela($materialFivela) {
        $this->materialFivela = $materialFivela;
    }
}