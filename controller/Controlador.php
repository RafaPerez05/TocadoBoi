<?php
require_once("../model/BancoDeDados.php");
require_once("../model/Cliente.php");
require_once("../model/Produto.php");


class Controlador{

    //Atributo
    private $bancoDeDados;

    function __construct(){
        $this->bancoDeDados = new BancoDeDados("localhost","root","","toca");
    }

    public function cadastrarProduto($nome, $fabricante, $descricao, $valor, $imagem){

        $produto = new Produto($nome,$fabricante,$descricao,$valor,$imagem);
        $this->bancoDeDados->inserirProduto($produto);
    }

    public function cadastrarCliente($nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha){
        $cliente  = new Cliente($nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha);
        $this->bancoDeDados->inserirCliente($cliente);
    }

    public function visualizarProdutos(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutos();
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
                "<tr>".
                    "<td>". $produto["cod"] ."</td>".
                    "<td>". $produto["nome"] ."</td>".
                    "<td>". $produto["fabricante"] ."</td>".
                    "<td>". $produto["descricao"] ."</td>".
                    "<td>". $produto["valor"] ."</td>".
                    "<td>".
                        "<form method='post' action='../processamento/processamentoExcluirProduto.php'>".
                            "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                            "<button class='btn btn-danger' type='submit' name='excluir_produto'>Excluir</button>". // Botão para excluir
                        "</form>".
                    "</td>".
                    "<td>".
                    "<form method='post' action='../processamento/processamentoAlterarProduto.php'>".
                        "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                        "<button class='btn btn-warning' type='submit' name='excluir_produto'>Alterar</button>". // Botão para alterar
                    "</form>".
                    "</td>".
                "</tr>".
                "</tbody>";
        }
        return $prod;
    }

    public function visualizarClientes(){

        $cli = "";

        $listaClientes = $this->bancoDeDados->retornarClientes();
        while($cliente = mysqli_fetch_assoc($listaClientes)){
            $cli .= "<section class=\"conteudo-bloco\">
            <h2>".$cliente['nome'].$cliente['sobrenome']."</h2>
            <a>Cpf: ".$cliente['cpf']."</a><br>
            <a>Data de Nascimento: ".$cliente['dataNascimento']."</a><br>
            <a>Telefone: ".$cliente['telefone']."</a><br>
            <a>Email: ".$cliente['email']."</a><br>
            <a>Senha: ".$cliente['senha']."</a>
            </section>";
        }
        return $cli;
    }

    public function excluirProduto($cod){
        $this->bancoDeDados->excluirProdutos($cod);
    }
    

}

?>