<?php
    session_start();
    include_once('../database/conexao.php');
    $idP = $_GET['p'];
    if(empty($idP)){
        header('location: ../index.php');
    }
    $sql = mysqli_query($conexao, "SELECT *, date_format(productcreate, '%d/%m/%Y') FROM products WHERE idProduct = $idP");
    $r = $sql->fetch_assoc();
    $nomeP = $r['nomeProduct'];
    $donoP = $r['ownerProduct'];
    $photoP = $r['photoProduct'];
    $descricaoP = $r['description'];
    $precoP = $r['price'];
    $sinceP = $r["date_format(productcreate, '%d/%m/%Y')"];

    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE id = $donoP");
    $r = $sql->fetch_assoc();
    $nomeUser = $r['nome'];
    $idUser = $r['id'];
    
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="produto.css">
    <script src="produto.js"></script>
    <link rel="stylesheet" href="../classes.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $nomeP ?></title>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../assets/icone.ico" alt="" class="icon">
        </a>
        <div class="header_1">
            <a href="../promotions/promotions.php" class="line-of-options" style="color: white;">Promoções</a>
            <a href="" class="line-of-options" style="color: white;">Loja</a>
            <a href="" class="line-of-options" style="color: white;">Ajuda</a>
        </div>
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
    </header>
    <main>
        <section class="section_1">
            <img src="<?php echo "../$photoP" ?>" class="img-section">
        </section>
        <section class="section_2">
            <div class="box-info">
                <h1>Nome</h1>
                <p><?php echo $nomeP ?></p>
                <h1>Descriçao</h1>
                <p><?php echo $descricaoP ?></p>
                <h1>Dono</h1>
                <a href='<?php echo "../loja/loja.php?l=$idUser" ?>' class="line-of-options"><?php echo $nomeUser ?></a>
                <h1>Preço</h1>
                <p>R$ <?php echo $precoP ?></p>
                <a href="" class="btn-buy">Comprar</a>
            </div>
        </section>
    </main>
</body>
</html>