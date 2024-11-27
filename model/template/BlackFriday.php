<?php
class BlackFriday {
    private $nome;
    private $desconto;

    public function __construct($nome, $desconto) {
        $this->nome = $nome;
        $this->desconto = $desconto;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getTipo() {
        return 'BlackFriday';
    }

    public function getDesconto() {
        return $this->desconto;
    }
}
