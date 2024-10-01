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
    if(isset($_POST['email']) && isset($_POST['senha'])){
        $email = $conexao -> real_escape_string($_POST['email']);
        $senha = $conexao -> real_escape_string($_POST['senha']);

        $VerficarLogin = "SELECT * FROM tb_sgb_gerente WHERE gerente_email = '$email' AND gerente_senha = '$senha' AND gerente_ativo = 1";
        $executeLogin = $conexao -> query($VerficarLogin);

        if($executeLogin && $executeLogin -> num_rows > 0){
            $rowGerente = $executeLogin -> fetch_assoc();

            $_SESSION['gerente_email'] = $rowGerente['gerente_email'];
            $_SESSION['gerente_senha'] = $rowGerente['gerente_senha'];
            $_SESSION['gerente_nome'] = $rowGerente['gerente_nome'];
            $_SESSION['gerente_id'] = $rowGerente['id_gerente'];

            header('Location: ../pgs/home.php', true, 301);
        }else{
            $rowGerente = $executeLogin -> fetch_assoc();

            $email_db = $rowGerente['gerente_email'];
            $senha_db = $rowGerente['gerente_senha'];
            $ativo_db = $rowGerente['gerente_ativo'];

            if($email != $email_db && $senha == $senha_db){
                header('Location: ../index.php?status=failE', true, 301);
                exit();
            } elseif($email == $email_db && $senha != $senha_db){
                header('Location: ../index.php?status=failS', true, 301);
                exit();
            } else{
                header('Location: ../index.php?status=failES', true, 301);
                exit();
            }
        }
    }else{
        header('Location: ../index.php?status=failDNF', true, 301);
        exit();
    }
}