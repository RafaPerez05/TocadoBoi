<?php

class BancoDeDados{
    private $host;
    private $login;
    private $senha;
    private $dataBase;

    public function __construct($Host, $Login, $Senha, $DataBase){
        $this->host = $Host;
        $this->login = $Login;
        $this->senha = $Senha;
        $this->dataBase = $DataBase;
    }

    //Métodos
    public function conectarBD(){

        $conexao = mysqli_connect($this->host,$this->login,$this->senha,$this->dataBase);
        return($conexao);
    }

    public function verificaLoginBD($email,$senha){
        $conexao = $this->conectarBD();
        $sql_code = "SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);
        $quantidade = $sql_query->num_rows;
        if($quantidade == 1){
            
            return $usuario = $sql_query->fetch_assoc();
        }
        else{
            $sql_code = "SELECT * FROM funcionario WHERE email = '$email' AND senha = '$senha'";
            $sql_query = $conexao->query($sql_code) or die("Falha na execução do código SQL: " . $conexao->error);
            $quantidade = $sql_query->num_rows;
            if($quantidade == 1){
                
                return $usuario = $sql_query->fetch_assoc();
            }
            else{
                return "Falha";
            }
    }
}

    public function inserirProduto($produto){
        
        $conexao = $this->conectarBD();
        $consulProd= "INSERT INTO produto (nome, fabricante, descricao, valor, imagem_path, sexo) 
                     VALUES ('{$produto->get_Nome()}','{$produto->get_Fabricante()}','{$produto->get_Descricao()}','{$produto->get_Valor()}','{$produto->get_Imagem()}','{$produto->get_Sexo()}')";
        mysqli_query($conexao,$consulProd);
    }
    
    public function inserirCliente($cliente){
        
        $conexao = $this->conectarBD();
        $consulta = "INSERT INTO cliente (nome, sobrenome, cpf, dataNascimento, telefone, email, senha) 
                     VALUES ('{$cliente->get_nome()}','{$cliente->get_sobrenome()}', '{$cliente->get_cpf()}','{$cliente->get_datanasc()}','{$cliente->get_telefone()}','{$cliente->get_email()}','{$cliente->get_senha()}')";
        mysqli_query($conexao,$consulta);
    }
    
    
    public function retornarClientes(){
    
        $conexao = $this->conectarBD();
        $consulta = "SELECT * FROM cliente";
        $listaClientes = mysqli_query($conexao,$consulta);
        return $listaClientes;
    }
    
    public function retornarProdutos(){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto";
        $listaProdutos = mysqli_query($conexao,$consulProd);
        return $listaProdutos;
    }
    public function retornarProdutosCod($cod){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto WHERE cod = $cod";
        $Produto = mysqli_query($conexao,$consulProd);
        return $Produto;
    }

    public function retornarProdutosSexoM(){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto WHERE sexo = 'Masculino'";
        $Produto = mysqli_query($conexao,$consulProd);
        return $Produto;
    }
    public function retornarProdutosSexoF(){
        $conexao = $this->conectarBD();
        $consulProd = "SELECT * FROM produto WHERE sexo = 'Feminino'";
        $Produto = mysqli_query($conexao,$consulProd);
        return $Produto;
    }

    public function excluirProdutos($cod){
        $conexao = $this->conectarBD();
        
        $query = "DELETE FROM produto WHERE cod = $cod";
        
        if(mysqli_query($conexao, $query)){
            echo "Produto excluído com sucesso.";
        } else{
            echo "Erro ao excluir o produto: " . mysqli_error($conexao);
        }
    }

}

?>