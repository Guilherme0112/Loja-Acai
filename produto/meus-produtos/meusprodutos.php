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
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../classes.css">
    <link rel="stylesheet" href="meusprodutos.css">
    <script src="meusprodutos.js"></script>
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <title>Meus Produtos</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../../index.php">
                <img src="../../assets/icone.ico" alt="" class="icon">
            </a>
            <a href="../../loja/loja.php" class="line-of-options" style="color: white;">Minha Loja</a>
            <a href="../../criar/criar.php" class="line-of-options" style="color: white;">Postar Produto</a>
            <a href="../../config/config.php" class="line-of-options" style="color: white;">Editar Perfil</a>
        </div>
        <div class='header_2'>
            <a href='../../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <section class="section">
        
    </section>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM products WHERE ownerProduct = $idSession");
            if(mysqli_num_rows($sql) != 0){     
                while($i = $sql->fetch_assoc()){
                    $idP = $i['idProduct'];
                    $nomeP = $i['nomeProduct'];
                    $precoP = $i['price'];
                    $photoP = $i['photoProduct'];
                    $exPreco = number_format(((17/100) * $precoP) + $precoP, 2);
                    
                    echo "<div class='box-p'>
                            <img src='../../$photoP' class='photo'>
                            <a href='../produto.php?p=$idP' class='nome-p line-of-options'>$nomeP</a>
                            <p class='preco-p'>R$ $precoP</p>
                            <a href='../editar/editar.php?p=$idP' class='edit fa-solid fa-pencil'></a>
                        </div>";
                }
            } else {
                echo "<p class='msg-product'>
                        Você não postou nenhum produto
                        <a href='../../criar/criar.php' class='line-of-options'>Postar agora</a>
                    </p>"; 
            }
        ?>
    </main>
</body>
</html>