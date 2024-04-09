<?php
require_once("../model/BancoDeDados.php");
require_once("../model/Cliente.php");
require_once("../model/Produto.php");
require_once("../model/Carrinho.php");
require_once("../model/Venda.php");



class Controlador{

    //Atributo
    private $bancoDeDados;

    function __construct(){
        $this->bancoDeDados = new BancoDeDados("localhost","root","","toca");
    }

    public function verificaLogin($email,$senha){
        $usuarioLogado = $this->bancoDeDados->verificaLoginBD($email,$senha);
        session_destroy();
        if (session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }

        if(!empty($usuarioLogado[0]))
        {
            $_SESSION["cod"] = $usuarioLogado[0]['cod'];
            $_SESSION["nome"] = $usuarioLogado[0]['nome'];
            if($usuarioLogado[1] == "cliente"){
                header('Location:../view/clienteVerProduto.php');
            }
            else
                header('Location:../view/home.php');

        }
        else
        {
            echo "tratamento de erros";
        }
        

        

    }

    public function adcionarCarrinho($cliente_cod,$produto_cod,$quantidade){
        $carrinho = new Carrinho($cliente_cod,$produto_cod,$quantidade);
        $this->bancoDeDados->inserirCarrinho($carrinho);
    }
    public function visualizarProdutosCarrinho(){
        $prod="";
        $listaProdutosCarrinho = $this->bancoDeDados->retornarProdutosCarrinho();
        while($produto = mysqli_fetch_assoc($listaProdutosCarrinho)){
            $prod .=
            "<div class='col-lg-4 col-md-6'>".
            "<div class='product-card'>".
                "<img src='". $produto["caminho_imagem"] ."' alt='Product Image' class='product-image'>".
                "<div class='product-name'>".$produto["nome_produto"]."</div>".

                //form
                "<form class='col-lg-0 col-md-0' action='../processamento/#' method='post'>".
                    "<input type='number' id='valor' class='product-price' value='". $produto["valor_produto"] ."'readonly style='border: none; background: transparent; outline: none;text-align: center;' readonly>".
                    "<input id='quantidade' min='1' step='1' type='number'name='quantidade_carrinho' value='". $produto["quantidade"] ."'>".
                    "<button type='submit' class='btn btn-danger btn-add-to-cart'>Remover do Carrinho <i class='fa fa-shopping-cart'></i></button>". // Botão submit
                "</form>". // Fecha o formulário
            "</div>".
        "</div>";
        }
        return $prod;
    }

    public function cadastrarProduto($nome, $fabricante, $descricao, $valor, $imagem, $sexo){

        $produto = new Produto($nome,$fabricante,$descricao,$valor,$imagem,$sexo);
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
                    "<td>". $produto["sexo"] ."</td>".
                    "<td>".
                        "<form method='post' action='../processamento/processamentoExcluirProduto.php'>".
                            "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                            "<button class='btn btn-danger' type='submit' name='excluir_produto'>Excluir</button>". // Botão para excluir
                        "</form>".
                    "</td>".
                    "<td>".
                    "<a class='btn btn-warning openModalAlterar' name='alterar_produto'>Alterar</a>".
                    "</td>".
                "</tr>".
                "</tbody>";
        }
        return $prod;
    }
    public function visualizarProdutosModal(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutosCod(17);
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
            "<section class='conteudo-formulario-cadastro'>\n" .
            "    <form action='../processamento/processamento.php' method='POST' enctype='multipart/form-data'>\n" .
            "        <label>Alterar Produto</label>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='nome' class='form-label'>Codigo</label>\n" .
            "            <input type='text' class='form-control' name='inputNomeProd' placeholder='Nome' value='". $produto["cod"] ."' readonly>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='nome' class='form-label'>Nome</label>\n" .
            "            <input type='text' class='form-control' name='inputNomeProd' placeholder='Nome' value='". $produto["nome"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='fabricante' class='form-label'>Fabricante</label>\n" .
            "            <input type='text' class='form-control' name='inputFabricanteProd' placeholder='Fabricante' value='". $produto["fabricante"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='descricao' class='form-label'>Descrição</label>\n" .
            "            <input type='text' class='form-control' name='inputDescricaoProd' placeholder='Descrição' value='". $produto["descricao"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='valor' class='form-label'>Valor</label>\n" .
            "            <input type='text' class='form-control' name='inputValorProd' placeholder='Valor' value='". $produto["valor"] ."'>\n" .
            "        </div>\n" .
            "        <div class='mb-3'>\n" .
            "            <label for='formFile' class='form-label'>Imagem</label>\n" .
            "             <img src='". $produto["imagem_path"] ."' alt='Sua Imagem' style='max-width: 100%; height: auto;'>\n" .
            "            <label for='formFile' class='form-label'>Imagem</label>\n" .
            "            <input class='form-control' type='file' id='formFile' name='inputimagemProd' accept='image/jpeg, image/png' required>\n" .
            "        </div>\n" .
            "        <button type='submit' class='btn btn-primary'>Cadastrar</button>\n" .
            "    </form>\n" .
            "</section>\n";
        }
        return $prod;
    }
    public function visualizarProdutosGrid(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutos();
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
            "<div class='col-lg-4 col-md-6'>".
            "<div class='product-card'>".
                "<img src='". $produto["imagem_path"] ."' alt='Product Image' class='product-image'>".
                "<div class='product-name'>".$produto["nome"]."</div>".
                "<div class='product-description'>". $produto["descricao"] ."</div>".
                "<div class='product-price'>R$". $produto["valor"] ."</div>".
                "<form action='../processamento/processamentoVendas.php' method='post'>". // Adiciona um formulário ao redor do botão
                    "<input type='hidden' name='produto_cod' value='". $produto["cod"] ."'>". // Adiciona um campo oculto com o nome do produto
                    "<input  type='hidden' name='cliente_cod' value='". $_SESSION["cod"] ."'>". // 
                    "<input type='hidden' name='valor_total' value='". $produto["valor"] ."'>". // Adiciona um campo oculto com o valor total
                    "<input type='hidden' name='quantidade' value='" . "1" . "'>".
                    "<button type='submit' class='btn btn-warning btn-add-to-cart'>Adicionar ao Carrinho <i class='fa fa-shopping-cart'></i></button>". // Botão submit
                "</form>". // Fecha o formulário
            "</div>".
        "</div>";
        }
        return $prod;
    }
    public function visualizarProdutosMasc(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutosSexoM();
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
            "<div class='col-lg-4 col-md-6'>".
                "<div class='product-card'>".
                    "<img src='". $produto["imagem_path"] ."'alt='Product Image' class='product-image'>".
                    "<div class='product-name'>".$produto["nome"]."</div>".
                    "<div class='product-description'>". $produto["descricao"] ."</div>".
                    "<div class='product-price'>R$". $produto["valor"] ."</div>".
                    "<button class='btn btn-warning btn-add-to-cart'>Adicionar ao Carrinho</button>".
                "</div>".
            "</div>";
        }
        return $prod;
    }
    public function visualizarProdutosFem(){
        $prod="";
        $listaProdutos = $this->bancoDeDados->retornarProdutosSexoF();
        while($produto = mysqli_fetch_assoc($listaProdutos)){
            $prod .=
            "<div class='col-lg-4 col-md-6'>".
                "<div class='product-card'>".
                    "<img src='". $produto["imagem_path"] ."'alt='Product Image' class='product-image'>".
                    "<div class='product-name'>".$produto["nome"]."</div>".
                    "<div class='product-description'>". $produto["descricao"] ."</div>".
                    "<div class='product-price'>R$". $produto["valor"] ."</div>".
                    "<button class='btn btn-warning btn-add-to-cart'>Adicionar ao Carrinho</button>".
                "</div>".
            "</div>";
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