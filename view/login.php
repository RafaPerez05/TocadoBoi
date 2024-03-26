<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="icon" href="../img/logo.png" type="image/png">
    <title>Toca do Boi</title>
<body>
    <section class="conteudo-login">
        <section class="conteudo-formulario">
            <img src="../imagens/mylogo.png" alt="Logo" style="width: 50px;">
            <p>Bem vindo a toca</p>
            <form id="form-log" method="POST" action="../processamento/processamento.php">
                <input id="input-log" type="text" placeholder="Email" name="inputEmailLog">
                <input id="input-log" type="password" placeholder="Senha" name="inputSenhaLog">
                <input id="botao-log" type="submit" value="ENTRE">
            </form>
            <p>Novo na Toca? <a href="cadastroCliente.php">Cadastrar</a></p>
        </section>
    </section>

    <footer class="rodape-login">
        <p>© 2024 Toca do boi. Todos os direitos reservados</p>
    </footer>
</body>
</html>