<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../index.php');
    }
    //
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    //
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $ajuda = $_POST['ajuda'];
        if(strlen($title) > 3 && strlen($title) < 50){
            if(strlen($ajuda) > 3 && strlen($ajuda) < 300){
                $sql = mysqli_query($conexao, "INSERT INTO ajuda VALUES (DEFAULT, $idSession, '$title', '$ajuda', DEFAULT, DEFAULT)");
                if($sql){
                    header('location: ../index.php');
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
    <link rel="stylesheet" href="../classes.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <script src="ajuda.js"></script>
    <link rel="stylesheet" href="ajuda.css">
    <title>Ajuda</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php" class="icon-a">
                <img src="../assets/icone.ico" class="icon">
            </a>
            <a href='../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
            <a href='../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
            <a href='../criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
            <a href='../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
            <a href='../loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return vali()">
            <label for="title">Título: </label>
            <input type="text" name="title" id='title' placeholder="Título do problema">
            <label for="ajuda">Descrição</label>
            <textarea name="ajuda" id='ajuda' placeholder="Descreva seu problema"></textarea>
            <button type="submit" name="submit">Enviar</button>
        </form>
    </main>
</body>
</html>