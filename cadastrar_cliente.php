<?php

// função para limpar caracteres que não sejam números
function limpar_numeros($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}
//iniciando a variavel erro para explanar na tela caso ocorra
$erro = false;

//recebendo os valores
if (count($_POST) > 0) {

    include('conexao.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nasc = $_POST['nasc'];
    $tele = $_POST['tele'];

    // tratamento dos valores recebidos:
    if (empty($nome)) {
        $erro = "Preencha o nome corretamente !";
    }

    if (empty($email) and !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o email de forma válida !";
    }

    if (empty($nasc)) {
        $erro = "Preencha o nascimento com o padrão dia-mês-ano !";
    }


    if (!empty($tele)) {
        $tele = limpar_numeros($tele);
        if (strlen($tele)  > 13) {
            $erro = "Preencha o telefone no padrão '(11) 11111-1111' !";
        }
    }

    // spam para avisar de determinado erro: 
    if ($erro) {
        echo "<p><b> ERRO: $erro </b></p>";
    } else {

        //insersão dos dados tratados no banco: 
        $sql_code = "INSERT INTO cliente (nome, email, nascimento, telefone, data_cadastro) VALUES ('$nome', '$email', '$nasc', '$tele', NOW())";
        $efetivado = $mysqli->query($sql_code) or die($mysqli->error);
        if ($efetivado) {
            echo "Cliente cadastrado com sucesso !";
            unset($_POST);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do cliente</title>
</head>

<body>
    <a href="/clientes.php">Voltar para lista! </a>
    <form method="POST" action="">
        <label for="nome">Nome: </label> <br>
        <input value="<?php if (isset($_POST['nome'])) echo $_POST['nome'] ?>" name="nome" type="text"> <br><br>

        <label for="email">Email: </label> <br>
        <input value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" name="email" type="email"> <br><br>

        <label for="nasc">Nascimento: </label> <br>
        <input value="<?php if (isset($_POST['nasc'])) echo $_POST['nasc'] ?>" name="nasc" type="date"> <br><br>

        <label for="tele">Telefone: </label> <br>
        <input value="<?php if (isset($_POST['tele'])) echo $_POST['tele'] ?>" placeholder="(11) 11111-1111" name="tele" type="text"> <br><br>

        <input type="submit" value="Cadastrar !">
    </form>
</body>

</html>