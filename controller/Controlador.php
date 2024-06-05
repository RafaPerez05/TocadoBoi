<?php
require_once("../model/BancoDeDados.php");
require_once("../model/Cliente.php");
require_once("../model/Produto.php");
require_once("../model/Carrinho.php");
require_once("../model/Venda.php");
require_once("../model/Endereco.php");
require_once ("../model/FactoryProduto.php");




class Controlador{

    //Atributo
    private $bancoDeDados;

    //metodo singleton
    function __construct(){
        // Obter a instância única do BancoDeDados
        $this->bancoDeDados = BancoDeDados::getInstance();
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
        session_start();
        $prod="";
        $usuarioLogado = $_SESSION["cod"];
        $endereco = $this->bancoDeDados->retornarEndereco($usuarioLogado);
        if ($endereco !== null) {
            $codEndereco = $endereco['cod'];
        } else {
            $codEndereco = 0;
        }


        $listaProdutosCarrinho = $this->bancoDeDados->retornarProdutosCarrinho($usuarioLogado);
        while($produto = mysqli_fetch_assoc($listaProdutosCarrinho)){
            $prod .=
            "<div class='d-flex flex-row justify-content-between align-items-center pt-lg-4 pt-2 pb-3 border-bottom mobile'>" .
           " <div class='d-flex flex-row align-items-center'>" .
                "<div><img src='". $produto["caminho_imagem"] ."' width='150' height='150' alt='' id='image'></div>" .
                "<div class='d-flex flex-column pl-md-3 pl-1'>" .
                    "<div>" .
                        "<h6>".$produto["nome_produto"]."</h6>" .
                    "</div>" .
                "</div>" .
            "</div>" .
            "<div class='pl-md-0 pl-1'><b>R$ ". $produto["valor_produto"] ."</b></div>" .
            //botoes de quantidade abaixo
            
                //"<form action='' method=''>".
                    "<input type='hidden' name='cod' value='". $produto["codigo_carrinho"] ."' readonly>".
                    "<button type='submit' class='btn btn-secondary increase' data-target='quantity".$produto["codigo_carrinho"]."' data-add='add".$produto["codigo_carrinho"]."' type='button'> <i class='fa fa-plus' aria-hidden='true'></i> </button>" .
                //"</form>".

                "<input type='text' class='px-md-3 px-1' 
                id='add".$produto["codigo_carrinho"]."'
                 value='". $produto["quantidade"] ."'
                style='border: none; background: transparent; outline: none;text-align: center'readonly
                size='1'
                ></input>" .

                //"<form action='' method=''>".
                    "<input type='hidden' name='cod' value='". $produto["codigo_carrinho"] ."' readonly>".
                    "<button  type='submit' class='btn btn-secondary decrease' data-target='quantity".$produto["codigo_carrinho"]."' data-add='add".$produto["codigo_carrinho"]."'><i class='fa fa-minus' aria-hidden='true'></i></button>" .
                //"</form>".


            "<input class='pl-md-0 pl-1' 
            id='quantity".$produto["codigo_carrinho"]."'
            type='text' value='". $produto["valor_produto"] ."'
            style='border: none; background: transparent; outline: none;text-align: center'readonly
                size='1' ></input>" .

            "<form action='../processamento/processamentoExcluirCarrinho.php' method='post'>".
            "<input type='hidden' name='cod' value='". $produto["codigo_carrinho"] ."' readonly>".             
            "<button type='submit' class='btn btn-danger'><i class='fa fa-trash-o' aria-hidden='true'></i>
            </button>" .
            "</form>".
        "</div>" .
   " </div>" .

   //teste modal
   "<div id='myModal' class='modal' >" .
   "<div class='modal-content'>" .
   "<span class='close'>"."&times;"."</span>".
    "<section class='conteudo-formulario-cadastro'>" .
        "<form action='../processamento/processamentoAddEndereco.php' method='POST' enctype='multipart/form-data'>" .
        
        "<section class='form-endereco'>" .
            "<label>Dados do endereço para entrega</label>" .
            //codigo de usuario
            "<input type='hidden' class='form-control' name='inputUsuarioLogado' value='".$usuarioLogado."'></input>" .
            //codigo do endereco
            "<input type='hidden' id='codEndereco' class='form-control' name='inputEndereco' value='". $codEndereco."'></input>" .


            "<div class='mb-3'>" .
                "<label for='CEP' class='form-label'>CEP</label>" .
                "<input type='number' class='form-control' name='inputCep' placeholder='Cep'required></input>" .
            "</div>" .

            "<div class='mb-3'>" .
                "<label for='Rua' class='form-label'>Rua</label>" .
                "<input type='text' class='form-control' name='inputRua' placeholder='Rua' required>" .
            "</div>" .

            "<div class='mb-3'>" .
                "<label for='Numero' class='form-label'>Número</label>" .
                "<input type='number' class='form-control' name='inputNumero' placeholder='Número' required>" .
            "</div>" .

            "<div class='mb-3'>" .
                "<label for='Bairro' class='form-label'>Bairro</label>" .
                "<input type='text' class='form-control' name='inputBairro' placeholder='Bairro' required>" .
            "</div>" .

            "<div class='mb-3'>" .
                "<label for='Complemento' class='form-label'>Complemento</label>" .
                "<input type='text' class='form-control' name='inputComplemento' placeholder='Complemento (opcional)'>" .
            "</div>" .  
                  
            "<button type='submit' class='btn btn-primary'>Cadastrar</button>" .
        "</section>" .
        "</form>" .
   "</section>" .
    "</div>" .
    "</div>";




        }
        return $prod;
    }

    public function excluirCarrinho($cod){
        $this->bancoDeDados->excluirCarrinho($cod);
    }

    public function cadastrarProduto($dados) {
        $produto = FactoryProduto::factoryMethod($dados);
        if($produto == null){
            echo "Deu merda!";
        }
        else{
            $this->bancoDeDados->inserirProduto($produto);
        }
    }
    
    

    public function cadastrarCliente($cod, $nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha){
        $cliente  = new Cliente($cod, $nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha);
        $this->bancoDeDados->inserirCliente($cliente);
    }

    public function alterarCliente($cod, $nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha){
        $cliente  = new Cliente($cod, $nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha);
        $this->bancoDeDados->alterarCliente($cliente);
    }

    public function excluirCliente($cod){
        $this->bancoDeDados->excluirCliente($cod);
    }
                    
    public function cadastrarEndereco($cod,$inputUsuarioLogado, $inputCep, $inputRua, $inputNumero, $inputBairro, $inputComplemento){
        $endereco  = new Endereco($cod,$inputUsuarioLogado, $inputCep, $inputRua, $inputNumero, $inputBairro, $inputComplemento);
        $this->bancoDeDados->cadastrarEndereco($endereco);
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
                    "<td>". $produto["tipo"] ."</td>".

                    "<td>".
                        "<form method='post' action='../processamento/processamentoExcluirProduto.php'>".
                            "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                            "<input type='hidden' name='tipo' value='". $produto["tipo"] ."'>".

                            "<button class='btn btn-danger' type='submit' name='excluir_produto'><i class='fa fa-trash'></i></button>". // Botão para excluir
                        "</form>".
                    "</td>".
                    "<td>".

                    "<form method='post' action='../processamento/processamentoAlterarProduto.php'>".
                        "<input type='hidden' name='cod' value='". $produto["cod"] ."'>".
                        "<input type='hidden' name='tipo' value='". $produto["tipo"] ."'>".
                        
                        "<button class='btn btn-warning  type='submit' openModalAlterar' name='alterar_produto'>Alterar</button>".
                    "</form>".

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
            "<div class='col-lg-4 col-md-6 ' id='". $produto["tipo"] . "'>".
            "<div class='product-card' >".
                "<img src='". $produto["imagem_path"] ."' alt='Product Image' class='product-image'>".
                "<div class='product-name'>".$produto["nome"]."</div>".
                "<div class='product-description'>". $produto["descricao"] ."</div>".
                "<div class='product-price'>R$". $produto["valor"] ."</div>".

                "<form action='../processamento/processamentoVendas.php' method='post'>".           
                //Adiciona um formulário ao redor do botão
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


    public function visualizarClientes(){
        $cli="";
        $listaClientes = $this->bancoDeDados->retornarClientes();
        while($cliente = mysqli_fetch_assoc($listaClientes)){
            $cli .=
                "<tr>".
                    "<td>". $cliente["cod"] ."</td>".
                    "<td>". $cliente["cpf"] ."</td>".
                    "<td>".$cliente['nome']."</td>".
                    "<td>".$cliente['sobrenome']."</td>".
                    "<td>".$cliente['email']."</td>".
                    "<td>".$cliente['telefone']."</td>".


                    "<td>".
                        "<form method='post' action='../processamento/processamentoExcluirCliente.php'>".
                            "<input type='hidden' name='cod' value='". $cliente["cod"] ."'>".

                            "<button class='btn btn-danger' type='submit' name='excluir_produto'><i class='fa fa-trash'></i></button>". // Botão para excluir
                        "</form>".
                    "</td>".

                    // Adcionar depois de fazer a função para finalizar venda
//                    "<td>".
//                    "<form method='post' action='../processamento/processamentoAlterarProduto.php'>".
//                        "<input type='hidden' name='cod' value='". $cliente["cod"] ."'>".                        
//                        "<button class='btn btn-warning  type='submit' openModalAlterar' name='alterar_produto'>Alterar</button>".
//                    "</form>".
//                    "</td>".
                "</tr>".
                "</tbody>";
        }

        return $cli ;


    }
    
    public function visualizarClienteLogado(){
        $cli = "";
        $usuarioLogado = $_SESSION["cod"];
        $listaClientes = $this->bancoDeDados->retornarClienteLogado($usuarioLogado);
        while($cliente = mysqli_fetch_assoc($listaClientes)){
            $cli .= 

            "<input id='input-log' type='hidden' class='form-control mb-4' Value='".$cliente['cod']."' placeholder='Nome' name='inputCod' readonly>" .

            "<div class='form-group'>" .
                "<input id='input-log' type='text' class='form-control mb-4' Value='".$cliente['nome']."' placeholder='Nome' name='inputNome' required>" .
            "</div>" .

            "<div class='form-group'>" .
                "<input id='input-log' type='text' class='form-control mb-4' Value='".$cliente['sobrenome']."' placeholder='Sobrenome' name='inputSobrenome' required>".
            "</div>" .

            "<div class='form-group'>" .
            "<input id='input-log' type='text' class='form-control mb-4' Value='".$cliente['cpf']."'placeholder='CPF' name='inputCPF' maxlength='11' required>" .
            "</div>" .

            "<div class='form-group'>" .
            "<input id='input-log' type='date' class='form-control mb-4' Value='".$cliente['dataNascimento']."' placeholder='Data de nascimento' name='inputDataNasc' required>" .
            "</div>".

            "<div class='form-group'>".
                "<input id='input-log' type='tel' class='form-control telefone mb-4' Value='".$cliente['telefone']."' pattern='\(?[0-9]{2}\)?\s?[0-9]{4,5}-?[0-9]{4}' placeholder='Telefone' name='inputTelefone' required>" .
            "</div>".

            "<div class='form-group'>".
                "<input id='input-log' type='email' class='form-control mb-4'  Value='".$cliente['email']."' placeholder='Email' name='inputEmail' required>" .
            "</div>".

            "<div class='form-group'>" .
                "<input id='input-log' type='text' class='form-control mb-4'  Value='".$cliente['senha']."' placeholder='Senha' name='inputSenha' required>" .
            "</div>"

            ;
        }
        return $cli;
    }

    public function excluirProduto($cod,$tipo){
        $this->bancoDeDados->excluirProdutos($cod,$tipo);
    }



}

?>