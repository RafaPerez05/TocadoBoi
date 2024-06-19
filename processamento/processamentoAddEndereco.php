<?php
require_once("../controller/Controlador.php");
$controlador = new Controlador();
//Cadastro endereco
if (isset($_POST['inputUsuarioLogado']) &&
    isset($_POST['inputCep']) && 
    isset($_POST['inputRua']) && 
    isset($_POST['inputNumero']) && 
    isset($_POST['inputBairro'])) {

    $cod = "";
    $inputUsuarioLogado = $_POST['inputUsuarioLogado'];
    $inputCep = $_POST['inputCep'];
    $inputRua = $_POST['inputRua'];
    $inputNumero = $_POST['inputNumero'];
    $inputBairro = $_POST['inputBairro'];
    
    // inputComplemento pode ser nulo, então verificamos sua existência e atribuimos um valor padrão se não estiver definido
    $inputComplemento = isset($_POST['inputComplemento']) ? $_POST['inputComplemento'] : null;


    $controlador->cadastrarEndereco($cod,$inputUsuarioLogado, $inputCep, $inputRua, $inputNumero, $inputBairro, $inputComplemento);

    $totalVazio = 0;
    $dataAtual = date("Y/m/d H:i:s");
    
    $controlador->iniciarVenda($inputUsuarioLogado,$totalVazio,$dataAtual);

    //header('Location:../view/clienteCarrinho.php');
    die();
}