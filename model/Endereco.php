<?php

class Endereco {

    protected $cod;
    protected $cod_cliente;
    protected $cep;
    protected $rua;
    protected $numero;
    protected $bairro;
    protected $complemento;

    public function __construct($cod, $cod_cliente, $cep, $rua, $numero, $bairro, $complemento) {
        $this->cod = $cod;
        $this->cod_cliente = $cod_cliente;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->complemento = $complemento;
    }

    public function get_cod() {
        return $this->cod;
    }

    public function set_cod($cod) {
        $this->cod = $cod;
    }

    public function get_cod_cliente() {
        return $this->cod_cliente;
    }

    public function set_cod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }

    public function get_cep() {
        return $this->cep;
    }

    public function set_cep($cep) {
        $this->cep = $cep;
    }

    public function get_rua() {
        return $this->rua;
    }

    public function set_rua($rua) {
        $this->rua = $rua;
    }

    public function get_numero() {
        return $this->numero;
    }

    public function set_numero($numero) {
        $this->numero = $numero;
    }

    public function get_bairro() {
        return $this->bairro;
    }

    public function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    public function get_complemento() {
        return $this->complemento;
    }

    public function set_complemento($complemento) {
        $this->complemento = $complemento;
    }
}

?>