<?php
    session_start();
    include_once('../database/conexao.php');
    if(isset($_SESSION['email'])){
        header('location: ../index.php');
    }
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $senha = $_POST['pass'];
        $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email' AND senha = '$senha'");
        if(mysqli_num_rows($sql) == 1){
            $_SESSION['email'] = $email;
            header('location: ../loja/loja.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="../classes.css">
    <script src="login.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
</head>
<body>
    <main>
        <section id='img'>
        </section>
        <section>
            <div>
                <button id='back' onclick="back()"><</button>
            </div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method='POST'>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                <label for="pass">Senha</label>
                <input type="password" name="pass" id="pass" required>
                <a href="">Esqueci minha senha</a>
                <button type="submit" name="submit">Entrar</button>
                <a href="../register/register.php">Não tenho conta</a>
            </form>
        </section>
    </main>
</body>
</html>