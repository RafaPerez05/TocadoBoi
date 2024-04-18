<?php
require_once "../controller/Controlador.php";
include "clienteLayout/cabecalho.php";
session_start();

?>

<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card center-card">
      <div class="card text-center">
        <h4 class="card-title m-3">Olá 
        <?php echo  $_SESSION['nome']; ?>, deseja alterar seus dados?</h4>
        </div>
        <div class="card-body">
          <form>
                <?php
                    $controlador = new Controlador();
                    echo $controlador->visualizarClienteLogado();
                ?>
            <button id="botao-log" type="submit" class="btn btn-warning btn-block">ALTERAR</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
document.querySelector('.telefone').addEventListener('input', function (e) {
    var telefone = e.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
    var formattedTelefone;

    // Limita a quantidade de caracteres inseridos
    if (telefone.length > 11) {
        telefone = telefone.slice(0, 11);
    }

    // Formatação do número de telefone
    if (telefone.length === 11) {
        formattedTelefone = telefone.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    } else if (telefone.length === 10) {
        formattedTelefone = telefone.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    } else {
        formattedTelefone = telefone;
    }

    e.target.value = formattedTelefone;
});
</script>
<?php
  include "layout/rodape.php";
?>