<head>
    <link rel="stylesheet" href="style/delete.css">
</head>
<?php
$id = intval($_GET['id']);
if (isset($_POST['sim'])) {
    include("conexao.php");
    $sql_code = "DELETE FROM cliente WHERE id = '$id'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    if ($sql_query) { ?>
        <h1>Cliente deletado com sucesso!</h1>
        <a class="voltar_listas" href="clientes.php">Voltar para lista de clientes!</a>
        <?php
        die();
        ?>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar cliente</title>
</head>

<body>
    <h1 class="h1delete">Tem certeza que deseja deletar o cliente <?php echo $id ?> ?</h1>
    <a href="clientes.php"><button class="buttonSim">Não</button></a>
    <form action="" method="POST">
        <button class="buttonNao" name="sim" value="1" type="submit">Sim</button>
    </form>
</body>

</html>