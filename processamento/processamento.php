<?php

session_start();
require_once("../controller/Controlador.php");
require_once ("../model/FactoryProduto.php");

$controlador = new Controlador();

//Login
if(isset($_POST['inputEmailLog']) 
&& isset($_POST['inputSenhaLog'])){

    //$_SESSION['estaLogado'] = TRUE;
    $email = $_POST['inputEmailLog'];
    $senha = $_POST['inputSenhaLog'];

    $controlador->verificaLogin($email, $senha);
    die();
    
}

//Cadastro de Cliente
if(isset($_POST['inputNome']) &&
   isset($_POST['inputSobrenome']) && 
   isset($_POST['inputCPF']) && 
   isset($_POST['inputDataNasc']) && 
   isset($_POST['inputTelefone']) && 
   isset($_POST['inputEmail']) &&
   isset($_POST['inputSenha'])
   
   )
{   
    $cod = "";
    $nome = $_POST['inputNome'];
    $sobrenome = $_POST['inputSobrenome'];
    $cpf = $_POST['inputCPF'];
    $dataNasc = $_POST['inputDataNasc'];
    $telefone = $_POST['inputTelefone'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];
    
    $controlador->cadastrarCliente($cod,$nome, $sobrenome, $cpf, $dataNasc, $telefone, $email, $senha);

    header('Location:../view/login.php');
    die();
}



//Cadastro de Produto
if (
    !empty($_POST['inputNomeProd']) && 
    !empty($_POST['inputFabricanteProd']) && 
    !empty($_POST['inputDescricaoProd']) && 
    !empty($_POST['inputValorProd']) && 
    !empty($_FILES['inputimagemProd']) &&
    !empty($_POST['inputSexoProd']) &&
    !empty($_POST['inputTipoProd']) &&
    !empty($_POST['inputTamanhoProd']) &&
    !empty($_POST['inputMaterialProd'])
) {
    // Obter os dados do formulário
    $dados = [
        'nome' => $_POST['inputNomeProd'],
        'fabricante' => $_POST['inputFabricanteProd'],
        'descricao' => $_POST['inputDescricaoProd'],
        'valor' => $_POST['inputValorProd'],
        'sexo' => $_POST['inputSexoProd'],
        'tipo' => $_POST['inputTipoProd'],
        'tamanho' => $_POST['inputTamanhoProd'],
        'material' => $_POST['inputMaterialProd'],
        'altura_cano' => $_POST['inputAltCanoProd'] ?? null,
        'modelo' => $_POST['inputModeloProd'] ?? null,
        'cor' => $_POST['inputCorProd'] ?? null,
        'estilo' => $_POST['inputEstiloProd'] ?? null,
        'circunferencia' => $_POST['inputCircunferenciaProd'] ?? null,
        'largura' => $_POST['inputLarguraProd'] ?? null,
        'material_fivela' => $_POST['inputFivelaProd'] ?? null
    ];

    // Upload da imagem
    $imagem_produto = $_FILES['inputimagemProd']['name'];
    $imagem_temp = $_FILES['inputimagemProd']['tmp_name'];
    $upload_dir = "../imagens/uploads/";
    $dados['imagem_destino'] = $upload_dir . $imagem_produto;

    if (move_uploaded_file($imagem_temp, $dados['imagem_destino'])) {
        $controlador->cadastrarProduto($dados);
        header('Location:../view/cadastroProduto.php');
        die();
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
}


?>