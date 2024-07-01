<?php
    session_start();
    include_once('../../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="password.css">
    <script src="password.js"></script>
    <link rel="stylesheet" href="../../classes.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <title>Trocar Senha</title>
</head>
<body>
    <header>
        <a href="../../index.php">
            <img src="../../assets/icone.ico" class="icon">
        </a>
        <div class="header_1">
            <a href="../config.php" class="line-of-options">Configurações</a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="newPass">Digite a Nova Senha:</label>
            <input type="password" name="newPass" id="newPass" placeholder='Digite sua Nova Senha' required>
            <label for="newPass">Repita a Nova Senha:</label>
            <input type="password" name="rPass" id="rPass" placeholder='Repita sua Nova Senha' required>
            <label for="newPass">Digite sua Senha:</label>
            <input type="password" name="pass" placeholder="Digite sua Senha Atual" required>
            <button type="submit" class='btn' name="submit">Enviar</button>
        </form>
    </main>
</body>
</html>