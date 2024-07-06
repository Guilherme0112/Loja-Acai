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
    if(!isset($_GET['a']) || empty($_GET['a'])){
        header('location: ../index.php');
    }
    $idA = $_GET['a'];
    $sql = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idAjuda = $idA");
    if(mysqli_num_rows($sql) > 0){
        $r = $sql->fetch_assoc();
        $titleAjuda = $r['titleAjuda'];
        $ajuda = $r['ajuda'];
        $time = $r["date_format(timeAjuda, '%d/%m/%Y')"];
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajuda.css">
    <link rel="stylesheet" href="../classes.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $titleAjuda ?></title>
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
            <a href='central.php' class='fa-solid fa-question' style='color: white;'></a>
        </div>
    </header>
    <main>
        <div class='box-div'>
            <h3 class='nome'>
                <?php echo $titleAjuda ?>
            </h3>
            <p class='time'> <?php echo $time ?> </p>
            <span>
                <?php echo $ajuda ?>
            </span>
        </div>
        <span style="width: 100%;"></span>
        <?php
            $sql = mysqli_query($conexao, "SELECT *, date_format(time, '%d/%m/%Y') FROM rajuda WHERE idPost = $idA");
            if(mysqli_num_rows($sql) > 0){
                while($i = $sql->fetch_assoc()){
                    $resposta = $i['resposta'];
                    $time = $i["date_format(time, '%d/%m/%Y')"];
                }

                echo "<div class='box-div'>
                        <h3 class='nome'>
                            Staff
                        </h3>
                        <p class='time'>$time</p>
                        <span>
                            $resposta
                        </span>
                    </div>
                    <span style='width: 100%;'></span>
                    ";
            }
        ?>
    </main>
</body>
</html>