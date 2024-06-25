<?php
include('conexao.php');

$sql_clientes = "SELECT * FROM cliente";
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes</title>
    <link rel="stylesheet" href="clientes.css">
</head>

<body>
    <h1>Lista de clientes!</h1>
    <a class="voltar_cadastro" href="cadastrar_cliente.php">Voltar para o cadastro!</a>
    <h2>Clientes cadastrados no seu sistema: </h2>

    <table style="border: 1px solid black;" cellpadding="10">
        <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Nascimento</th>
            <th>Telefone</th>
            <th>Cadastro</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php if ($num_clientes === 0) {
            ?>
                <tr>
                    <td colspan="7">Nenhum cliente foi encontrado!</td>
                </tr>
                <?php } else {
                while ($cliente = $query_clientes->fetch_assoc()) {

                    $telefone = "Não informado";
                    if (!empty($cliente['telefone'])) {
                        $ddd = substr($cliente['telefone'], 0, 2);
                        $telefonept1 = substr($cliente['telefone'], 2, 5);
                        $telefonept2 = substr($cliente['telefone'], 7);
                        $telefone = "($ddd) $telefonept1-$telefonept2";
                    }

                ?>
                    <tr>
                        <td><?php echo $cliente['id']; ?></td>
                        <td><?php echo $cliente['nome']; ?></td>
                        <td><?php echo $cliente['email']; ?></td>
                        <td><?php echo $cliente['nascimento']; ?></td>
                        <td><?php echo $telefone; ?></td>
                        <td><?php echo $cliente['data_cadastro']; ?></td>
                        <td class="edit"><a href="editar_cliente.php?id=<?php echo $cliente['id'] ?>">Editar</a></td>
                        <td class="remove"><a href="deletar_cliente.php?id=<?php echo $cliente['id'] ?>">Deletar</a></td>
                    </tr>

            <?php }
            } ?>
        </tbody>
    </table>
</body>

</html>