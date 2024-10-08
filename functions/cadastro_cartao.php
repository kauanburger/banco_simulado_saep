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
    if(isset($_POST['cliente_numero_conta']) && isset($_POST['cliente_endereco']) && isset($_POST['id_cliente'])){
        
        $cliente_numero_conta = $conexao -> real_escape_string($_POST['cliente_numero_conta']);
        $cliente_endereco = $conexao -> real_escape_string($_POST['cliente_endereco']);
        $id_cliente = $conexao -> real_escape_string($_POST['id_cliente']);

        $InsertCliente = "UPDATE tb_sgb_cliente
        SET cliente_numero_conta = '$cliente_numero_conta',
            cliente_endereco = '$cliente_endereco'
        WHERE id_cliente = '$id_cliente'";


        $executeInsert = $conexao -> query($InsertCliente);

        if($executeInsert){
            header('Location: ../pgs/home.php', true, 301);
            exit();
        }else{
            header('Location: ../pgs/cadastrar_cartao.php?status=fail', true, 301);
            exit();
        }

    }
}