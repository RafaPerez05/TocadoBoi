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
                <input id="input-log" type="text" placeholder="Nome" name="inputNome" required>
                <input id="input-log" type="text" placeholder="Sobrenome" name="inputSobrenome" required>
                <input id="input-log" type="text" placeholder="CPF" name="inputCPF" maxlength="11" required>
                <input id="input-log" type="date" placeholder="Data de nascimento" name="inputDataNasc" required>
                <input class="telefone" id="input-log" type="tel" pattern="\(?[0-9]{2}\)?\s?[0-9]{4,5}-?[0-9]{4}" placeholder="Telefone" name="inputTelefone" required>
                <input id="input-log" type="email" placeholder="Email" name="inputEmail" required>
                <input id="input-log" type="password" placeholder="Senha" name="inputSenha" required>
                <input id="botao-log" type="submit" value="CADASTRAR-SE">
            </form>
            <p>Já tem cadastro? <a href="login.php">Entrar</a></p>
        </section>
    </section>


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

</body>
</html>