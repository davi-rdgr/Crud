<?php

include('conexao.php'); // Inclui o arquivo de conexão com o banco de dados

// Função para limpar caracteres que não sejam números
function limpar_numeros($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

// Iniciando a variável erro para explanar na tela caso ocorra
$erro = false;
$efetivado = false;

// Iniciando o tratamento do ID anteriormente
$id = intval($_GET['id']); // Converte o ID recebido via GET para inteiro

// Recebendo os valores do formulário
if (count($_POST) > 0) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nasc = $_POST['nasc'];
    $tele = $_POST['tele'];

    // Tratamento dos valores recebidos:
    if (empty($nome)) {
        $erro = "Preencha o nome corretamente !";
    }

    // Verifica se o email está vazio ou é inválido
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

    // Se não houver erros, atualiza os dados do cliente no banco de dados
    if (!$erro) {

        // Atualização dos dados tratados pegando o ID tratado do começo do código
        $sql_code = "UPDATE cliente 
        SET nome = '$nome',
        email = '$email',
        nascimento = '$nasc',
        telefone = '$tele'
        WHERE id = '$id'";
        $efetivado = $mysqli->query($sql_code) or die($mysqli->error); // Executa a consulta e trata erros
        if ($efetivado) {
            unset($_POST); // Limpa os dados do formulário após a atualização
        }
    }
}

// Seleciona os dados do cliente a partir do ID
$sql_cliente = "SELECT * FROM cliente WHERE id = '$id'";
$query_cliente = $mysqli->query($sql_cliente) or die($mysqli->error);
$cliente = $query_cliente->fetch_assoc(); // Armazena os dados do cliente
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização do cliente</title>
    <link rel="stylesheet" href="style/cadastrar_cliente.css">
</head>

<body>
    <main>
        <h1>Atualização de cliente!</h1>
        <a class="voltar_listas" href="/CRUD/clientes.php">Ver os clientes na lista</a>
        <div class="errospam">
            <?php
            // Exibe mensagens de erro ou sucesso
            if ($erro) echo $erro;
            if ($efetivado) echo "<div class='sucesso'>Cliente atualizado com sucesso</div>";
            ?>
        </div>
        <form method="POST" action="">
            <label for="nome">Nome</label> <br>
            <input value="<?php echo $cliente['nome'] ?>" name="nome" type="text"> <br><br>

            <label for="email">Email</label> <br>
            <input value="<?php echo $cliente['email'] ?>" name="email" type="email"> <br><br>

            <label for="nasc">Nascimento</label> <br>
            <input value="<?php echo $cliente['nascimento'] ?>" name="nasc" type="date"> <br><br>

            <label for="tele">Telefone</label> <br>
            <input value="<?php echo $cliente['telefone'] ?>" placeholder="(11) 11111-1111" name="tele" type="text"> <br><br>

            <input class="input_submit" type="submit" value="Salvar cliente">
        </form>
    </main>
</body>

</html>