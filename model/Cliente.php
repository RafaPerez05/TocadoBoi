<?php

class Cliente{

    protected $nome;
    protected $sobrenome;
    protected $cpf;
    protected $datanasc;

    protected $telefone;
    protected $email;
    protected $senha;

    public function __construct($Nome, $sobrenome, $Cpf, $datanasc, $telefone, $email, $senha)
    {
        $this->nome = $Nome;
        $this->sobrenome = $sobrenome;
        $this->cpf = $Cpf;
        $this->datanasc = $datanasc;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->senha = $senha;
    }

    public function get_nome(){
        return($this->nome);
    }

    public function set_nome($Nome){
        $this->nome = $Nome;
    }

    

    public function get_sobrenome(){
        return($this->sobrenome);
    } 

    public function set_sobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }


   

    public function get_cpf(){
        return($this->cpf);
    }
    
    
    public function set_cpf($Cpf){
        $this->cpf = $Cpf;
    }


    public function get_datanasc(){
        return($this->datanasc);
    } 


    public function set_datanasc($datanasc){
        $this->datanasc = $datanasc;
    }
    
    public function get_telefone(){
        return($this->telefone);
    }

    public function set_telefone($telefone){
        $this->telefone = $telefone;
    }


    public function get_email(){
        return($this->email);
    }
   
    public function set_email($email){
        $this->email = $email;
    }
    
    public function get_senha(){
        return($this->senha);
    }
    public function set_senha($senha){
        $this->senha = $senha;
    }
}

?>