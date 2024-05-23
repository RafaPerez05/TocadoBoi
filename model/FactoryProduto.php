<?php

require_once "Bota.php";
require_once "Camisa.php";
require_once "Chapeu.php";
require_once "Cinto.php";

class FactoryProduto {

    static function factoryMethod($FabTipo, $Nome, $Fabricante, $Descricao, $Valor, $Imagem, $Sexo, $Tamanho, $Material, $Tipo, $extra1 = null, $extra2 = null) {
        switch($FabTipo) {
            case "BOTA":
                return new Bota($Nome, $Fabricante, $Descricao, $Valor, $Imagem, $Sexo, $Tamanho, $Material, $Tipo, $extra1);
            case "CAMISA":
                return new Camisa($Nome, $Fabricante, $Descricao, $Valor, $Imagem, $Sexo, $Tamanho, $Material, $Tipo, $extra1, $extra2);
            case "CHAPEU":
                return new Chapeu($Nome, $Fabricante, $Descricao, $Valor, $Imagem, $Sexo, $Tamanho, $Material, $Tipo, $extra1, $extra2);
            case "CINTO":
                return new Cinto($Nome, $Fabricante, $Descricao, $Valor, $Imagem, $Sexo, $Tamanho, $Material, $Tipo, $extra1, $extra2);
            default:
                return null;
        }
    }
}


?>