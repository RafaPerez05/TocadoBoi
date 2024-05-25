<?php

require_once "Bota.php";
require_once "Camisa.php";
require_once "Chapeu.php";
require_once "Cinto.php";

class FactoryProduto {

    static function factoryMethod($dados) {
        switch ($dados['tipo']) {
            case 'BOTA':
                return new Bota($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tamanho'], $dados['material'], $dados['tipo'], $dados['altura_cano']);
                break;
            case 'CAMISA':
                return new Camisa($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tipo'], $dados['tamanho'], $dados['material'], $dados['modelo'], $dados['cor']);
                break;
            case 'CHAPEU':
                return new Chapeu($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tipo'], $dados['tamanho'], $dados['material'], $dados['estilo'], $dados['circunferencia']);
                break;
            case 'CINTO':
                return new Cinto($dados['nome'], $dados['fabricante'], $dados['descricao'], $dados['valor'], $dados['imagem_destino'], $dados['sexo'], $dados['tipo'], $dados['tamanho'], $dados['material'], $dados['largura'], $dados['material_fivela']);
                break;
            default:
                return null;
        }
    }
}


?>