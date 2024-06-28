<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header('location: ../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $resp = $sql->fetch_assoc();
    $idSession = $resp['id'];
    $nome = $resp['nome'];
    $photoProfile = $resp['photoProfile'];
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loja.css">
    <link rel="stylesheet" href="../classes.css">
    <script src="loja.js"></script>
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <title><?php echo $nome ?></title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php">
                <img src="../assets/icone.ico" alt="" class="icon">
            </a>
            <a href="../promotions/promotions.php" class="line-of-options" style="color: white;">Promoções</a>
            <a href="../produto/meus-produtos/meusprodutos.php" class="line-of-options" style="color: white;">Meus Produtos</a>
            <a href="../criar/criar.php" class="line-of-options" style="color: white;">Postar Produto</a>
            <a href="../config/config.php" class="line-of-options" style="color: white;">Editar Perfil</a>
        </div>
        <div class='header_2'>
            <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <section class="first-part">
        <div>
            <img src="<?php echo $photoProfile ?>" class="photoUser">
        </div>
        <div>
            <p class="nome-user"><?php echo $nome ?></p>
        </div>
    </section>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM products WHERE ownerProduct = $idSession");
            if(mysqli_num_rows($sql) == 0){
                echo "
                        <p class='msg-product'>
                            Você não postou nenhum produto
                            <a href='../criar/criar.php' class='line-of-options'>Postar agora</a>
                        </p>
                        ";
            } else {
                while($i = $sql->fetch_assoc()){
                    $idP = $i['idProduct'];
                    $photoP = $i['photoProduct'];
                    $nomeP = $i['nomeProduct'];
                    $precoP = $i['price'];
                    echo "
                
                        <a href='../produto/produto.php?p=$idP' class='box'>
                            <img src='../$photoP' class='img'>
                            <p class='title-box line-of-options'>$nomeP</p>
                            <span class='preco'>
                            <del class='ex-preco'>R$ $precoP</del>
                            R$ $precoP
                        </span>
                        </a>";
                }
            }
        ?>
    </main>
</body>
</html>