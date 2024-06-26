<?php 

    // Configurações do banco de dados
    $host = "localhost";  // Endereço do servidor do banco de dados
    $db = "crud_cliente"; // Nome do banco de dados
    $user = "root";       // Nome de usuário do banco de dados
    $password = "";       // Senha do banco de dados

    // Criação de uma nova instância do objeto mysqli para conexão com o banco de dados
    $mysqli = new mysqli($host, $user, $password, $db);

    // Verifica se houve algum erro na conexão
    if($mysqli->connect_errno) {
        // Se houver um erro, a execução do script é interrompida e uma mensagem de erro é exibida
        die("Falha na conexão com banco de dados");
    }

?>
