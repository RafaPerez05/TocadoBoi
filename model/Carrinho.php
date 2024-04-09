<?php

class Carrinho {
    protected $cliente_cod;
    protected $produto_cod;
    protected $quantidade;

    public function __construct($cliente_cod, $produto_cod, $quantidade) {
        $this->cliente_cod = $cliente_cod;
        $this->produto_cod = $produto_cod;
        $this->quantidade = $quantidade;
    }

    public function get_clienteCod() {
        return $this->cliente_cod;
    }

    public function set_clienteCod($cliente_cod) {
        $this->cliente_cod = $cliente_cod;
    }

    public function get_produtoCod() {
        return $this->produto_cod;
    }

    public function set_produtoCod($produto_cod) {
        $this->produto_cod = $produto_cod;
    }

    public function get_quantidade() {
        return $this->quantidade;
    }

    public function set_quantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
}
