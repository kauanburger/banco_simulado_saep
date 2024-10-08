<?php
session_start();

// Conexão com o banco de dados
$hostname = "127.0.0.1";
$user = "root";
$password = "";
$database = "banco_database";

$conexao = new mysqli($hostname, $user, $password, $database);

if ($conexao->connect_errno) {
    echo "Falha na conexão com o MySQL: " . $conexao->connect_error;
    exit();
} else {
    if(isset($_POST['id_cliente'])){
        $numero_cliente = $conexao -> real_escape_string($_POST['id_cliente']);

        $DeleteCliente = "DELETE FROM tb_sgb_cliente WHERE id_cliente = '$numero_cliente'
        ";

        $executeDelete = $conexao -> query($DeleteCliente);

        if($executeDelete){
            header('Location: ../pgs/home.php', true, 301);
            exit();
        }else{
            header('Location: ../pgs/home.php?status=fail', true, 301);
            exit();
        }

    }
}