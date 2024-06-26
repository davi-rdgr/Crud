<?php

include('conexao.php');


// função para limpar caracteres que não sejam números
function limpar_numeros($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}
//iniciando a variavel erro para explanar na tela caso ocorra
$erro = false;
$efetivado = false;
//iniciando o tratamento do id anteriormente
$id = intval($_GET['id']);
//recebendo os valores
if (count($_POST) > 0) {


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
    if (!$erro) {

        //atualização dos dados tratados pegando o id tratado do começo do código: 
        $sql_code = "UPDATE cliente 
        SET nome = '$nome',
        email = '$email',
        nascimento = '$nasc',
        telefone = '$tele'
        WHERE id = '$id'";
        $efetivado = $mysqli->query($sql_code) or die($mysqli->error);
        if ($efetivado) {
            unset($_POST);
        }
    }
}


$sql_cliente = "SELECT * FROM cliente WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do cliente</title>
    <link rel="stylesheet" href="style/cadastrar_cliente.css">
</head>

<body>
    <main>
        <h1>Atualização de cliente! </h1>
        <a class="voltar_listas" href="/CRUD/clientes.php">Ver os clientes na lista</a>
        <div class="errospam">
            <?php
            if ($erro) echo $erro;
            if ($efetivado) echo "<div class='sucesso'>Cliente atualizado com sucesso</div>";
            ?>
        </div>
        <form method="POST" action="">
            <label for="nome">Nome </label> <br>
            <input value="<?php echo $cliente['nome'] ?>" name="nome" type="text"> <br><br>

            <label for="email">Email </label> <br>
            <input value="<?php echo $cliente['email'] ?>" name="email" type="email"> <br><br>

            <label for="nasc">Nascimento </label> <br>
            <input value="<?php echo $cliente['nascimento'] ?>" name="nasc" type="date"> <br><br>

            <label for="tele">Telefone </label> <br>
            <input value="<?php echo $cliente['telefone'] ?>" placeholder="(11) 11111-1111" name="tele" type="text"> <br><br>

            <input class="input_submit" type="submit" value="Salvar cliente">

        </form>
    </main>
</body>

</html>