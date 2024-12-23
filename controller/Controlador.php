<?php
require_once("../model/BancoDeDados.php");
require_once("../model/Cliente.php");
require_once("../model/Produto.php");
require_once("../model/Carrinho.php");
require_once("../model/Venda.php");
require_once("../model/Endereco.php");
require_once ("../model/FactoryProduto.php");
require_once("../model/JsonToCsvAdapter.php");
require_once("../model/SessionManager.php");




class Controlador{

    //Atributo
    private $bancoDeDados;

    //metodo singleton
    function __construct(){
        // Obter a instância única do BancoDeDados
        $this->bancoDeDados = BancoDeDados::getInstance();
    }

    public function verificaLogin($email, $senha) {
        $usuarioLogado = $this->bancoDeDados->verificaLoginBD($email, $senha);
        
        // Destruir a sessão anterior, se houver
        SessionManager::destroySession();
    
        if (!empty($usuarioLogado[0])) {
            // Corrigido o uso do set
            SessionManager::set("cod", $usuarioLogado[0]['cod']);
            SessionManager::set("nome", $usuarioLogado[0]['nome']);
    
            if ($usuarioLogado[1] == "cliente") {
                header('Location:../view/clienteVerProduto.php');
            } else {
                header('Location:../view/home.php');
            }
        } else {
            echo "tratamento de erros";
        }
    }
    


    public function adcionarCarrinho($cliente_cod,$produto_cod,$quantidade){
        $carrinho = new Carrinho($cliente_cod,$produto_cod,$quantidade);
        $this->bancoDeDados->inserirCarrinho($carrinho);
    }

    public function visualizarProdutosCarrinho(){
        $prod="";
        $usuarioLogado = SessionManager::get("cod");
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
        
        //inputs para venda



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
            
                  
            "<button type='submit' class='btn btn-primary'>Confirmar</button>" .
        "</section>" .
        "</form>" .
   "</section>" .
    "</div>" .
    "</div>";

        }
        // Adicionando o campo de cupom
$prod .=
"<form action='../processamento/processamentoCupom.php' method='POST' enctype='multipart/form-data'>" .

"<div class='d-flex flex-row justify-content-center align-items-center mt-4'>" .
"<input type='text' name='nomeCupom' id='couponCode' class='form-control' placeholder='Insira seu cupom' style='max-width: 300px; margin-right: 10px;'>" .
"<button id='applyCoupon' type='submit class='btn btn-primary'>Aplicar Cupom</button>" .
"</div>" .
"</form>" ;
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
    
    public function cadastrarCupom($cupom) {
        $nomeCupom = $cupom->getNome();
        $tipo = $cupom->getTipo();
        $desconto = $cupom->getDesconto();
    
        $this->bancoDeDados->inserirCupom($nomeCupom, $tipo, $desconto);
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
        $codCliente = SessionManager::get("cod");
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
                    "<input  type='hidden' name='cliente_cod' value='". $codCliente ."'>". // 
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
        $usuarioLogado = SessionManager::get("cod");
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

    public function iniciarVenda($cliente_cod, $valor_total, $data_venda) {
        $usuarioLogado = SessionManager::get("cod");
        $venda  = new Venda($cliente_cod, $valor_total, $data_venda);
        $listaProdutosCarrinho = $this->bancoDeDados->retornarProdutosCarrinho($usuarioLogado);
    
        if ($this->bancoDeDados->iniciarVenda($venda, $listaProdutosCarrinho)) {
            // Corrigido o uso do set
            SessionManager::set("venda_efetuada", true);
        } else {
            // Corrigido o uso do set
            SessionManager::set("venda_efetuada", false);
        }
    }
    

    public function exibirRelatorioVendas() {
        $relatorio = "";
        $listaVendas = $this->bancoDeDados->retornarRelatorioVendas();
        $totalVendas = 0;
        $totalValor = 0;
    
        while ($venda = mysqli_fetch_assoc($listaVendas)) {
            $totalVendas++;
            $totalValor += $venda["valor_total"];
            $dataVenda = date("d/m/Y", strtotime($venda["data_venda"]));
    
            $detalhesVenda = "<ul>";
            $produtos = explode(", ", $venda["produtos"]);
            $quantidades = explode(", ", $venda["quantidades"]);
            $valoresTotais = explode(", ", $venda["valores_totais"]);
            
            for ($i = 0; $i < count($produtos); $i++) {
                $detalhesVenda .= "<li>{$produtos[$i]} - Quantidade: {$quantidades[$i]} - Valor: R$ ". number_format($valoresTotais[$i], 2, ',', '.') ."</li>";
            }
            $detalhesVenda .= "</ul>";
    
            $relatorio .=
                "<tr>".
                    "<td>". $venda["venda_cod"] ."</td>".
                    "<td>". $venda["cliente_nome"] . " " . $venda["cliente_sobrenome"] ."</td>".
                    "<td>R$ ". number_format($venda["valor_total"], 2, ',', '.') ."</td>".
                    "<td>". $dataVenda ."</td>".
                    "<td>". $venda["rua"] . ", " . $venda["numero"] . ", " . $venda["bairro"] . ", " . $venda["cep"] ."</td>".
                    "<td><button class='btn btn-info' type='button' data-toggle='collapse' data-target='#detalhes-".$venda["venda_cod"]."'>Ver Detalhes</button></td>".
                "</tr>".
                "<tr class='collapse' id='detalhes-".$venda["venda_cod"]."'>".
                    "<td colspan='6'>".$detalhesVenda."</td>".
                "</tr>";
        }
        
        $totalizadores = "<tr><td colspan='2'><strong>Total de Vendas: </strong>{$totalVendas}</td><td colspan='4'><strong>Valor Total: </strong>R$ ". number_format($totalValor, 2, ',', '.') ."</td></tr>";
    
        return $totalizadores . $relatorio;
    }

    public function botoesBaixarRelatorio(){
        $botoes = "";
    
        $botoes .=
            "<div class='d-flex justify-content-center align-items-center'>".
                    "<form method='post' action='../processamento/processamentoBaixarJson.php'>".
                        "<input type='hidden' name='acao' value='baixarCsv'>".
                        "<button type='submit' id='downloadCsv' class='btn btn-primary mx-2'>Baixar CSV</button>".
                    "</form>".
    
                    "<form method='post' action='../processamento/processamentoBaixarJson.php'>".
                        "<input type='hidden' name='acao' value='baixarJson'>".
                        "<button type='submit' id='downloadJson' class='btn btn-secondary mx-2'>Baixar JSON</button>".
                    "</form>".
            "</div>";
    
        return $botoes;
    }

    public function gerarRelatoioJson(){
        $jsonData = "";

        if ($this->bancoDeDados->gerarJsonRelatorioVendas()) {
            echo "Relatorio Gerado com sucesso!";
            
        } else {
            echo "Falha ao gerar relatorio";
        }

    }

    public function gerarCsvRelatorioVendas() {
        // Obtém o JSON gerado
        $jsonData = $this->bancoDeDados->gerarJsonRelatorioVendas();
        
        // Instancia o adaptador com os dados JSON
        $adapter = new JsonToCsvAdapter($jsonData);
        
        // Define o caminho do arquivo CSV
        
        try {
            // Converte JSON para CSV e salva o arquivo
            $adapter->saveCsvToFile();
            return 'Arquivo CSV gerado/atualizado com sucesso.';
        } catch (Exception $e) {
            return 'Erro: ' . $e->getMessage();
        }
    }

    public function exibirQuantidadeCarrinho(){
        $input = "";
        $usuarioLogado =  SessionManager::get("cod");
        $quantidade = $this->bancoDeDados->retornarQuantidadeCarrinho($usuarioLogado);
        $quantidade = mysqli_fetch_assoc($quantidade);

        $input .=
                "<form id='quantidadeForm' method='post' action=''>".
                    "<input type='hidden' name='quantidadeCarrinhoBanco' value='" . $quantidade["total_produtos"] ."'>".
                "</form>";

    return $input;

    }
    
}

?>