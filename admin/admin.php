<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('locaiton: ../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    $sql = mysqli_query($conexao, "SELECT * FROM admin WHERE admin = $idSession");
    if(mysqli_num_rows($sql) === 0){
        header('location: ../index.php');
    }
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../classes.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <title>Administraçao</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php" class="icon-a">
                <img src="../assets/icone.ico" class="icon">
            </a>
        </div>
    </header>
    <main>
        <a href='posts/posts.php' class="option">
        <i class="fa-solid fa-pen-to-square icon-admin"></i>
            <h1>Posts</h1>
        </a>
        <a href='topicos/topicos.php' class="option">
            <i class="fa-solid fa-book icon-admin"></i>
            <h1>Tópicos</h1>
        </a>
        <a href='ajuda/ajuda.php' class="option">
            <i class="fa-solid fa-question icon-admin"></i>
            <h1>Ajuda</h1>
        </a>
    </main>
</body>
</html>