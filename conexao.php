<?php 

    $host = "localhost";
    $db = "crud_cliente";
    $user = "root";
    $password = "";


    $mysqli = new mysqli($host, $user, $password, $db);

    if($mysqli->connect_errno) {
        die("Falha na conexão com banco de dados");
    }

?>