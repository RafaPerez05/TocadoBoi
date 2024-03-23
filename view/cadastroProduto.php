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
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
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
<main>
<section class="slideshow">
      </div>
      <div class="direita">
        <h2>BEM-VINDO À</h2>
        <h1>Toca do Boi</h1>
        <p>Página do administrador </p>
      </div>
    </section>
        <!-- Modal -->
        <div id="myModal" class="modal">
        <!-- Conteúdo do modal -->
        <div class="modal-content">
        <span class="close">&times;</span>
            <section class="conteudo-formulario-cadastro">
                <form action="../processamento/processamento.php" method="POST">
                    <label>Cadastrar Produto</label>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="inputNomeProd" placeholder="Nome">
                    </div>
                    <div class="mb-3">
                        <label for="fabricante" class="form-label">Fabricante</label>
                        <input type="text" class="form-control" name="inputFabricanteProd" placeholder="Fabricante">
                    </div>
                    <div class="mb-3">
                        <label for="descrição" class="form-label">Descrição</label>
                        <input type="text" class="form-control" name="inputDescricaoProd" placeholder="Descrição">
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" class="form-control" name="inputValorProd" placeholder="Valor">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Imagem</label>
                        <input class="form-control" type="file" id="formFile" name="imagem">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
            </section>
            </div>
        </div>
        <section class="conteudo-visualizar">
        <section class="conteudo-visualizar-box">
            <h1>Produtos</h1>
        </section>
            <h3>Gerenciamento de Produtos</h3>
            <a id="openModal" class="btn btn-primary mb-3">Cadastrar novo produto</a>

            <table class="table table-striped zebrado">
            <thead>
                <tr>
                <th>Cod</th>
                <th>Nome do produto</th>
                <th>Fabricante</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th></th>
                </tr>
            </thead>
                    <?php
                        $controlador = new Controlador();
                        echo $controlador->visualizarProdutos();
                    ?>
            </table>
    </section>

</main>
<footer class="rodape-login">
        <p>© 2024 Toca do boi. Todos os direitos reservados</p>
</footer>

    <script>
    // Obter referências aos elementos do DOM
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("openModal");
    var span = document.getElementsByClassName("close")[0];

    // Quando o usuário clicar no botão "Novo", abrir o modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Quando o usuário clicar no botão de fechar, fechar o modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Quando o usuário clicar fora do modal, fechar o modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

</body>
</html>