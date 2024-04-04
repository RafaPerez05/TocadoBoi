<?php
  include "layout/cabecalho.php";
  session_start();

?>
<div>Bem Vindo  
<?php echo  $_SESSION['nome']; ?>
</div>

<?php
  include "layout/rodape.php";
?>
