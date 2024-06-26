<?php

include('conexao.php');

// função para limpar caracteres que não sejam números
function limpar_numeros($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

// iniciando a variável erro para explanar na tela caso ocorra
$erro = false;
$efetivado = false;

// recebendo os valores do formulário
if (count($_POST) > 0) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nasc = $_POST['nasc'];
    $tele = $_POST['tele'];

    // tratamento dos valores recebidos:
    if (empty($nome)) {
        $erro = "Preencha o nome corretamente !";
    }

    // Verifica se o email está vazio ou se é inválido
    if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha o email de forma válida !";
    }

    if (empty($nasc)) {
        $erro = "Preencha o nascimento com o padrão dia-mês-ano !";
    }

    // Limpeza e validação do telefone
    if (!empty($tele)) {
        $tele = limpar_numeros($tele);
        if (strlen($tele)  > 13) {
            $erro = "Preencha o telefone no padrão '(11) 11111-1111' !";
        }
    }

    // se não houver erros, insere os dados no banco de dados
    if (!$erro) {

        // inserção dos dados tratados no banco de dados
        $sql_code = "INSERT INTO cliente (nome, email, nascimento, telefone, data_cadastro) VALUES ('$nome', '$email', '$nasc', '$tele', NOW())";
        $efetivado = $mysqli->query($sql_code) or die($mysqli->error);
        if ($efetivado) {
            unset($_POST); // limpa os dados do formulário após o cadastro
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
    <link rel="stylesheet" href="style/cadastrar_cliente.css">
</head>

<body>
    <main>
        <h1>Cadastro de cliente!</h1>
        <a class="voltar_listas" href="/CRUD/clientes.php">Ver os clientes na lista</a>
        <div class="errospam">
            <?php
            // Exibe mensagens de erro ou sucesso
            if ($erro) echo $erro;
            if ($efetivado) echo "<div class='sucesso'>Cliente cadastrado com sucesso</div>";
            ?>
        </div>
        <form method="POST" action="">
            <label for="nome">Nome</label> <br>
            <input value="<?php if (isset($_POST['nome'])) echo $_POST['nome'] ?>" name="nome" type="text"> <br><br>

            <label for="email">Email</label> <br>
            <input value="<?php if (isset($_POST['email'])) echo $_POST['email'] ?>" name="email" type="email"> <br><br>

            <label for="nasc">Nascimento</label> <br>
            <input value="<?php if (isset($_POST['nasc'])) echo $_POST['nasc'] ?>" name="nasc" type="date"> <br><br>

            <label for="tele">Telefone</label> <br>
            <input value="<?php if (isset($_POST['tele'])) echo $_POST['tele'] ?>" placeholder="(11) 11111-1111" name="tele" type="text"> <br><br>

            <input class="input_submit" type="submit" value="Cadastrar">
            <input class="input_reset" type="reset" value="Limpar">
        </form>
    </main>
</body>

</html>