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
        <h3>Lista de clientes</h3>
        <table>
            <tr>
                <th>Número</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
            <tr>
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

                        if($executeClientes && $executeClientes -> num_rows > 0){
                            while($rowCliente = $executeClientes -> fetch_assoc()){
                                $numero_cliente = $rowCliente['id_cliente'];
                                $nome_cliente = $rowCliente['cliente_nome'];

                                echo '
                                    <tr>
                                        <td> 'echo . htmlspecialchars($numero_cliente). ;' </td>
                                        <td> 'echo . htmlspecialchars($nome_cliente). ;'</td>
                                        <td> </td>
                                    </tr>
                                ';
                            }
                        } else{
                            echo "Nenhum Cliente encontrado para você";
                        }
                    }
                ?>
                <td>

                </td>
            </tr>
        </table>
    </main>
</body>
</html>