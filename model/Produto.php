<?php

class Produto{

    //Atributos
    protected $nome;
    protected $fabricante;
    protected $descricao;
    protected $valor;
    protected $imagem;
    protected $sexo;
    protected $tamanho;
    protected $material;
    protected $tipo;



    //Construtor
    public function __construct($Nome,$Fabricante,$Descricao,$Valor,$Imagem,$Sexo,$Tipo, $Tamanho, $Material){
        $this->nome = $Nome;
        $this->fabricante = $Fabricante;
        $this->descricao = $Descricao;
        $this->valor = $Valor;
        $this->imagem = $Imagem;
        $this->sexo = $Sexo;
        $this->tamanho = $Tamanho;
        $this->material = $Material;
        $this->tipo = $Tipo;

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

    public function get_Tamanho(){
        return($this->tamanho);
    }

    public function set_Tamanho($Tamanho){
        $this->tamanho = $Tamanho;
    }

    public function get_Material(){
        return($this->material);
    }

    public function set_Material($Material){
        $this->material = $Material;
    }

    public function get_Tipo(){
        return($this->tipo);
    }

    public function set_Tipo($Tipo){
        $this->tipo = $Tipo;
    }

    //Métodos
    
}
?>