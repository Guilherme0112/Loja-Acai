<?php
    session_start();
    include_once('../../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    $senhaSession = $r['senha'];

    if(isset($_POST['submit'])){
        $novaSenha = $_POST['newPass'];
        $rNovaSenha = $_POST['rPass'];
        $senha = $_POST['pass'];
        if(strlen($novaSenha) > 4 && strlen($novaSenha) <= 16){
            if($novaSenha == $rNovaSenha){
                if($senha == $senhaSession){
                    $sql = mysqli_query($conexao, "UPDATE users SET senha = '$novaSenha' WHERE id = $idSession");
                    if($sql){
                        header('location: ../config.php');
                    }
                }
            }
        }
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
            <a href="../config.php" class="line-of-options">Editar Perfil</a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return vali()">
            <label for="newPass">Digite a Nova Senha:</label>
            <input type="password" name="newPass" id="newPass" placeholder='Digite sua Nova Senha' required>
            <label for="newPass">Repita a Nova Senha:</label>
            <input type="password" name="rPass" id="rPass" placeholder='Repita sua Nova Senha' required>
            <label for="newPass">Digite sua Senha:</label>
            <input type="password" name="pass" placeholder="Digite sua Senha Atual" required>
            <p id="msg"></p>
            <button type="submit" class='btn' name="submit">Enviar</button>
        </form>
    </main>
</body>
</html>