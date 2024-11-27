<?php

abstract class CupomTemplate {
    protected $nomeCupom;
    protected $desconto;

    public function __construct($nomeCupom, $desconto) {
        $this->nomeCupom = $nomeCupom;
        $this->desconto = $desconto;
    }

    // Template Method
    public function aplicarCupom($valorTotal) {
        if ($this->validarCupom()) {
            $valorComDesconto = $this->calcularDesconto($valorTotal);
            return $this->exibirMensagem($valorComDesconto);
        } else {
            return "Cupom inválido ou expirado.";
        }
    }

    // Método fixo (não alterável)
    private function validarCupom() {
        return true; 
    }

    // Métodos que as subclasses devem implementar
    abstract protected function calcularDesconto($valorTotal);
    abstract protected function exibirMensagem($valorComDesconto);
}
