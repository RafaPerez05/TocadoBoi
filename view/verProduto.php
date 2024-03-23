<?php
    
    require_once "../controller/Controlador.php";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="icon" href="../img/logo.png" type="image/png">
    <title>Toca do boi - Admin</title>
    <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/skills.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/form.css">
  <link rel="icon" type="image/png" href="imagens/mylogo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-s3QAG/Rg9BYLllDZ7tL0JCUUDvb/W+gJxvh+yMTxOKWpsqmM2axfChazddWJW6WA29oQmbpWzOyjUhQb5tbqWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

<header class="cabeça">
    <nav>
      <div class="logo">
        <a href="index.php">
          <img src="../imagens/mylogo.png" class="logo-img transition-soft">
        </a>
      </div>
      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>

      <ul class="nav-list">
        <li><a href="home.php">Início</a></li>
        <li><a href="verProduto.php">Produtos</a></li>
        <li><a href="cadastroProduto.php">Gerenciamento de Produtos</a></li>
        <li><a href="#contato"><i class="fa fa-shopping-cart"></i></a></li>
        <li><a href="#contato"><i class="fa fa-user"></i></a></li>

      </ul>
    </nav>
  </header>
  <section class="slideshow">
      </div>
      <div class="direita">
        <h2>BEM-VINDO À</h2>
        <h1>Toca do Boi</h1>
        <p>Página do administrador </p>
      </div>
    </section>
    <section>
    <div class="container">
      <div class="square design">
        <img src="https://picsum.photos/300/300" alt="Imagem">
        <div class="overlay">
          <h2>Flyer Promocional</h2>
          <p>flyer criado para uma cafeteria fictícia.</p>
          <!--FUTURO BOTÃO PARA ESPECIFICAÇÕES DO PROJETO-->
          <!-- <a href="html/bebida1.html"><button id="receita">Saiba mais</button></a> -->
        </div>
      </div>
      <div class="square design">
        <img src="https://picsum.photos/300/300" alt="Imagem">
        <div class="overlay">
          <h2>Convite de Aniversário</h2>
          <p>Flyer para enviar aos convidados de uma festa country.</p>
        </div>
      </div>
    </div>
    </section>
            

    <footer class="rodape-login">
        <p>© 2024 Toca do boi. Todos os direitos reservados</p>
    </footer>
</body>
</html>