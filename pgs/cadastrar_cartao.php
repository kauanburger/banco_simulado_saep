<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/cadastro_cartao.css">
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
            <h3 style="margin-bottom: 20px;">CADASTRO DO CARTÃO DO CLIENTE: </h3>
            <a href="home.php"> <button class="button_cadastrar">VOLTAR</button></a>
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
                        if(isset($_POST['id_cliente'])){
                            $id_cliente = $conexao -> real_escape_string($_POST['id_cliente']);
                            
                            $selectCliente = "SELECT * FROM tb_sgb_cliente
                            WHERE id_cliente = '$id_cliente' AND cliente_numero_conta IS NULL AND cliente_endereco IS NULL";
                            $executeSelect = $conexao -> query($selectCliente);

                            if($executeSelect && $executeSelect -> num_rows > 0){
                                ?>
                                <div class="insert_box">
                                    <form action="../functions/cadastro_cartao.php" method="POST">
                                    <?php
                                        if(isset($_GET['status']) && $_GET['status'] === 'fail'){
                                            echo '<h5>Erro ao cadastrar cartão</h5>';
                                        }else{
                                            echo '';
                                        }
                                    ?>
                                        <h5>Número da conta</h5>
                                        <input type="text" name="cliente_numero_conta">
                                        <br>
                                        <h5>Endereço</h5>
                                        <input type="text" name="cliente_endereco">
                                        <br>
                                        <br>
                                        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente ?>">
                                        <input type="submit" value="Cadastrar">
                                    </form>
                                </div>
                            <?php
                            } else{
                                echo '<h4> Este cliente já tem um cartão cadastrado </h4>';
                            }
                        }
                    }
                ?>
        </table>
    </main>
</body>
</html>