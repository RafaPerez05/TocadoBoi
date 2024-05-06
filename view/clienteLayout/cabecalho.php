<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="../imagens/mylogo.png" type="image/png">
    <title>Toca do boi - Cliente</title>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/grid.css">
    <link rel="icon" type="image/png" href="../imagens/mylogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-s3QAG/Rg9BYLllDZ7tL0JCUUDvb/W+gJxvh+yMTxOKWpsqmM2axfChazddWJW6WA29oQmbpWzOyjUhQb5tbqWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <header class="cabeça">
        <nav>
            <div class="logo">
                <a href="home.php">
                    <img src="../imagens/mylogo.png" class="logo-img transition-soft">
                </a>
            </div>
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="nav-list">
                <li><a href="clienteVerProduto.php">Produtos</a></li>
                <li><a href="clienteCarrinho.php"><i class="fa fa-shopping-cart"></i></a></li>
                <li><a href="clienteGerenciaUsuario.php"><i class="fa fa-user"></i></a></li>
                <li><a href="../processamento/sair.php">Sair</a></li>


            </ul>
        </nav>
    </header>
    <section class="slideshow">
        <ul>
            <li><img src="../imagens/modeloFeminina.jpg" alt="Imagem 1"
                    style="background-position: center; background-size: cover; height: 1080px;"></li>
            <li><img src="../imagens/modeloMasculino.jpg" alt="Imagem 2"
                    style="background-position: center; background-size: cover; height: 1080px;"></li>
        </ul>
    </section>