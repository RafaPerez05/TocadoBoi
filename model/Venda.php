<?php
    class Venda {
        protected $cliente_cod;
        protected $produto_cod;
        protected $quantidade;
        protected $valor_total;
        protected $data_venda;
    
        public function __construct($cliente_cod, $produto_cod, $quantidade, $valor_total, $data_venda) {
            $this->cliente_cod = $cliente_cod;
            $this->produto_cod = $produto_cod;
            $this->quantidade = $quantidade;
            $this->valor_total = $valor_total;
            $this->data_venda = $data_venda;
        }
    
        public function getClienteCod() {
            return $this->cliente_cod;
        }
    
        public function setClienteCod($cliente_cod) {
            $this->cliente_cod = $cliente_cod;
        }
    
        public function getProdutoCod() {
            return $this->produto_cod;
        }
    
        public function setProdutoCod($produto_cod) {
            $this->produto_cod = $produto_cod;
        }
    
        public function getQuantidade() {
            return $this->quantidade;
        }
    
        public function setQuantidade($quantidade) {
            $this->quantidade = $quantidade;
        }
    
        public function getValorTotal() {
            return $this->valor_total;
        }
    
        public function setValorTotal($valor_total) {
            $this->valor_total = $valor_total;
        }
    
        public function getDataVenda() {
            return $this->data_venda;
        }
    
        public function setDataVenda($data_venda) {
            $this->data_venda = $data_venda;
        }
    }
    