<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/cadastro_cliente.css">
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
    <div class="header_main">
            <h3 style="margin-bottom: 20px; margin-left: 40px;">Cadastrar Cliente</h3>
            <a href="home.php"> <button class="button_cadastrar">VOLTAR</button></a>
    </div>
    <main>
        <div class="insert_box">
            <form action="../functions/cadastro_cliente.php" method="POST">
            <?php
                if(isset($_GET['status']) && $_GET['status'] === 'fail'){
                    echo '<h5>Não foi possível cadastrar cliente</h5>';
                } else{
                    echo '';
                }
            ?>
                <h4>Nome</h4>
                
                <div>
                    <input type="text" name="nome_cliente">
                    <br>
                    <br>
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
        </div>  
    </main>
</body>
</html>