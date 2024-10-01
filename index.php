<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="imgs/logo.ico" type="image/x-icon">

</head>
<body>
    <main>
        <form action="functions/login.php" class="form_login" method="POST">
            <h4>Bem Vindo!</h4>
            <?php 
                if(isset($_GET['status']) && $_GET['status'] === 'failE'){
                    echo '<h5>Email incorreto</h5>';
                } elseif(isset($_GET['status']) && $_GET['status'] === 'failS'){
                    echo '<h5>Senha incorreta</h5>';
                }elseif(isset($_GET['status']) && $_GET['status'] === 'failDNF'){
                    echo '<h5>Dados não fornecidos</h5>';
                } elseif(isset($_GET['status']) && $_GET['status'] === 'failES'){
                    echo '<h5>Email e senha incorretos</h5>';
                }else{
                    echo '';
                }
            ?>
            <div class="inputs">
                <input type="email" name="email" class="input_forms" placeholder="Email">
                <input type="password" name="senha" class="input_forms" placeholder="Senha">
            </div>
            <input type="submit" name="Enviar" value="Entrar" id="input_submit">
        </form>
    </main>
</body>
</html>