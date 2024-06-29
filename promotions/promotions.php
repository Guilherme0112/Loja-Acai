<?php
    session_start();
    include_once('../database/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="promotions.css">
    <link rel="stylesheet" href="../classes.css">
    <script src="promotions.js"></script>
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Promoções</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php">
                <img src="../assets/icone.ico" alt="" class="icon">
            </a>
            <a href="" class="line-of-options" style="color: white;">Lojas</a>
            <a href="" class="line-of-options" style="color: white;">Ajuda</a>
            <a href="../config/config.php" class="line-of-options" style="color: white;">Editar Perfil</a>
        </div>
        <div class='header_2'>
        <?php 
            if(isset($_SESSION['email'])){
                echo "<div class='header_2'>
                        <a href='../loja/loja.php' title='Seu Perfil' class='fa-solid fa-user'></a>
                        <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
                    </div>";
            } else {

                echo "<div class='header_2'>
                        <a href='../login/login.php' title='Login' class='fa-solid fa-user'></a>
                    </div>";
            }
            
        ?>
        </div>
    </header>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM products ORDER BY RAND()");
            if(mysqli_num_rows($sql) == 0){
                echo "
                        <p class='msg-product'>
                            Não há produtos aqui
                        </p>
                        ";
            } else {
                while($i = $sql->fetch_assoc()){
                    $idP = $i['idProduct'];
                    $nomeP = $i['nomeProduct'];
                    $precoP = $i['price'];
                    $photoP = $i['photoProduct'];
                    $exPreco = number_format(((17/100) * $precoP) + $precoP, 2);

                    echo "<a href='../produto/produto.php?p=$idP' class='box'>
                            <img src='../$photoP' class='img'>
                            <p class='title-box line-of-options'>$nomeP</p>
                            <span class='preco'>
                                <del class='ex-preco'>R$ $exPreco</del>
                                R$ $precoP
                            </span>
                        </a>";
                }
               
            }
        ?>
    </main>
</body>
</html>