<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css">
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
            <h3 style="margin-bottom: 20px;">Lista de clientes</h3>
            <a href="cadastrar_cliente.php"> <button class="button_cadastrar">CADASTRAR CLIENTE</button></a>
        </div>
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
                        $SelectClientes = "SELECT * FROM tb_sgb_cliente WHERE id_tb_sgb_gerente = ".$_SESSION['gerente_id']."";

                        $executeClientes = $conexao -> query($SelectClientes);

                        if($executeClientes && $executeClientes -> num_rows > 0){?>
                            <table>
                                <tr>
                                    <th>Número</th>
                                    <th>Nome</th>
                                    <th>Ações</th>
                                </tr><?php
                            while($rowCliente = $executeClientes -> fetch_assoc()){
                                $numero_cliente = $rowCliente['id_cliente'];
                                $nome_cliente = $rowCliente['cliente_nome'];

                                ?>
                                <tr>
                                    <td> <?php echo htmlspecialchars($numero_cliente); ?> </td>
                                    <td> <?php echo htmlspecialchars($nome_cliente); ?></td>
                                    <td>
                                        <div class="acoes_row">
                                            <form action="visualizar_cliente.php" method="POST">
                                                <input type="hidden" name="id_cliente" value="<?php echo $numero_cliente ?>">
                                                <input type="hidden" name="nome_cliente" value="<?php echo $nome_cliente ?>">
                                                <input type="submit" value="Visualizar" id="alterar">
                                            </form>
                                            <form action="../functions/excluir_cliente.php" method="POST">
                                                <input type="hidden" name="id_cliente" value="<?php echo $numero_cliente ?>">
                                                <input type="submit" value="Excluir" id="delete">
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                echo' ';
                            }
                        } else{
                            echo "<h4 style='margin-left: 20px;'>Nenhum Cliente encontrado para você</h4>";
                        }
                    }
                ?>
        </table>
    </main>
</body>
</html>