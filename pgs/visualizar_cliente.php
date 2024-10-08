<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/visualizar_clientes.css">
    <link rel="icon" href="../imgs/logo.ico" type="image/x-icon">
    <script src="../js/exit.js"></script>
</head>
<body>
    <header>
        <h3>
            <?php
                session_start();
                echo $_SESSION['gerente_nome'];
            ?>
        </h3>
        <button class="exit_button" onclick="exit()">SAIR</button>
    </header>
    <main>
        <div class="header_main">
            <h3 style="margin-bottom: 20px;">INFORMAÇÕES DO CLIENTE: <?php echo $_POST['nome_cliente'] ?></h3>
            <a href="home.php"> <button class="button_cadastrar">VOLTAR</button></a>
        </div>
        <table>
            <tr>
                <th>Número</th>
                <th>Nome</th>
                <th>Número da conta</th>
                <th>Endereço</th>
                <th>Ações</th>
            </tr>
                <?php
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
                        if(isset($_POST['id_cliente']) && isset($_POST['nome_cliente'])){

                        $id_cliente = $conexao -> real_escape_string($_POST['id_cliente']);
                        $nome_cliente = $conexao -> real_escape_string($_POST['nome_cliente']);

                        $SelectClientes = "SELECT * FROM tb_sgb_cliente WHERE id_tb_sgb_gerente = ".$_SESSION['gerente_id']." AND id_cliente = '$id_cliente'";
                        $executeClientes = $conexao -> query($SelectClientes);

                        if($executeClientes && $executeClientes -> num_rows > 0){
                            while($rowCliente = $executeClientes -> fetch_assoc()){
                                $numero_conta = $rowCliente['cliente_numero_conta'];
                                $endereco_cliente = $rowCliente['cliente_endereco'];

                                ?>
                                <tr>
                                    <td> <?php echo htmlspecialchars($id_cliente); ?> </td>
                                    <td> <?php echo htmlspecialchars($nome_cliente); ?></td>
                                    <td><?php echo htmlspecialchars($numero_conta); ?></td>
                                    <td><?php echo htmlspecialchars($endereco_cliente); ?></td>
                                    <td>
                                        <form action="cadastrar_cartao.php" method= "POST">
                                            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>">
                                            <input type="hidden" name="nome_cliente" value="<?php echo $nome_cliente ?>">
                                            <input type="submit" value="Cadastar cartão" id="alterar">
                                        </form>
                                    </td>
                                </tr>
                                <?php
                                echo' ';
                            }
                        } else{
                            echo "Nenhum Cliente encontrado para você";
                        }
                    }
                    }
                ?>
        </table>
    </main>
</body>
</html>