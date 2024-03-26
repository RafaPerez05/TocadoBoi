<?php

class Produto{

    //Atributos
    protected $nome;
    protected $fabricante;
    protected $descricao;
    protected $valor;
    protected $imagem;
    protected $sexo;

    //Construtor
    public function __construct($Nome,$Fabricante,$Descricao,$Valor,$Imagem,$Sexo){
        $this->nome = $Nome;
        $this->fabricante = $Fabricante;
        $this->descricao = $Descricao;
        $this->valor = $Valor;
        $this->imagem = $Imagem;
        $this->sexo = $Sexo;
    }

    //Getter e Setter
    public function get_Nome(){
        return($this->nome);
    }

    public function set_Nome($Nome){
        $this->nome = $Nome;
    }

    public function get_Fabricante(){
        return($this->fabricante);
    }

    public function set_Fabricante($Fabricante){
        $this->fabricante = $Fabricante;
    }

    public function get_Descricao(){
        return($this->descricao);
    }

    public function set_Descricao($Descricao){
        $this->descricao = $Descricao;
    }

    public function get_Valor(){
        return($this->valor);
    }

    public function set_Valor($Valor){
        $this->valor = $Valor;
    }

    public function get_Imagem(){
        return($this->imagem);
    }

    public function set_Imagem($Imagem){
        $this->imagem = $Imagem;
    }

    public function get_Sexo(){
        return($this->sexo);
    }

    public function set_Sexo($Sexo){
        $this->sexo = $Sexo;
    }

    //Métodos
    
}
?>