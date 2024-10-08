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
    if(isset($_POST['nome_cliente'])){
        $nome_cliente = $conexao -> real_escape_string($_POST['nome_cliente']);

        $InsertCliente = "INSERT INTO tb_sgb_cliente (cliente_nome, cliente_numero_conta, cliente_endereco, id_tb_sgb_gerente)
        VALUES ('$nome_cliente', NULL, NULL, '{$_SESSION['gerente_id']}')
        ";

        $executeInsert = $conexao -> query($InsertCliente);

        if($executeInsert){
            header('Location: ../pgs/home.php', true, 301);
            exit();
        }else{
            header('Location: ../index.php?status=fail', true, 301);
            exit();
        }

    }
}