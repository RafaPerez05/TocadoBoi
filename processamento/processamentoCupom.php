<?php
require_once '../controller/controlador.php';
require_once '../model/template/BlackFriday.php';
require_once '../model/template/Natal2024.php';
$controlador = new Controlador();

if (isset($_POST['criarCupom'])) {
    $tipo = $_POST['tipoCupom']; // BlackFriday ou Natal2024
    $nomeCupom = $_POST['nomeCupom'];
    $desconto = floatval($_POST['desconto']); // Percentual ou valor fixo

    $controlador = new Controlador();

    if ($tipo === 'BlackFriday') {
        $cupom = new BlackFriday($nomeCupom, $desconto);
    } elseif ($tipo === 'Natal2024') {
        $cupom = new Natal2024($nomeCupom, $desconto);
    }

    // Salve as informações no banco de dados
    if (isset($cupom)) {
        $controlador->cadastrarCupom($cupom);
    }

    header('Location: ../view/cadastroProduto.php');
    exit;
}
