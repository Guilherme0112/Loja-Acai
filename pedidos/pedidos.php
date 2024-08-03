<?php
include_once "../database/conexao.php";
session_start();

if (!isset($_SESSION['email'])) {
    header('location: ../login/login.php');
}

    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();

    $idDB = $r['id'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pedidos.css">
    <script src="pedidos.js"></script>
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../classes.css">
    <title>Meus pedidos</title>
</head>

<body>
    <header>
        <a href="../index.php" class="icon_a">
            <img src="../assets/icone.ico" alt="" class="icon">
        </a>
        <div class="header_1">
            <a href='../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
            <a href='../criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
            <a href='../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
            <a href='../loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
        </div>
        <div class="header_2">
            <a href='../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
            <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM pedidos WHERE idUser = $idDB");
            if(mysqli_num_rows($sql) > 0){

            } else {
                echo "<p class='msg-product'>
                        Não existem pedidos
                    </p>";
            }
        ?>
    </main>
</body>

</html>