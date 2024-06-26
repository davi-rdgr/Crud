<head>
    <!-- Importa o arquivo CSS para estilização -->
    <link rel="stylesheet" href="style/delete.css">
</head>
<?php
// Obtém o ID do cliente a ser deletado da URL e o converte para inteiro
$id = intval($_GET['id']);

// Verifica se o botão 'sim' foi pressionado
if (isset($_POST['sim'])) {
    include("conexao.php"); // Inclui o arquivo de conexão com o banco de dados

    // Código SQL para deletar o cliente com o ID especificado
    $sql_code = "DELETE FROM cliente WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error); // Executa a consulta e trata erros

    // Verifica se a consulta foi bem-sucedida
    if ($sql_query) { ?>
        <h1>Cliente deletado com sucesso!</h1>
        <a class="voltar_listas" href="clientes.php">Voltar para lista de clientes!</a>
        <?php
        // Interrompe a execução do script
        die();
        ?>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar cliente</title>
</head>

<body>
    <!-- Mensagem de confirmação -->
    <h1 class="h1delete">Tem certeza que deseja deletar o cliente <?php echo $id ?>?</h1>
    <!-- Botão para cancelar a operação e voltar à lista de clientes -->
    <a href="clientes.php"><button class="buttonSim">Não</button></a>
    <!-- Formulário para confirmar a deleção do cliente -->
    <form action="" method="POST">
        <button class="buttonNao" name="sim" value="1" type="submit">Sim</button>
    </form>
</body>

</html>
