<?php
    class Venda {
        protected $cliente_cod;
        protected $valor_total;
        protected $data_venda;
    
        public function __construct($cliente_cod, $valor_total, $data_venda) {
            $this->cliente_cod = $cliente_cod;
            $this->valor_total = $valor_total;
            $this->data_venda = $data_venda;
        }
    
        public function getClienteCod() {
            return $this->cliente_cod;
        }
    
        public function setClienteCod($cliente_cod) {
            $this->cliente_cod = $cliente_cod;
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
    