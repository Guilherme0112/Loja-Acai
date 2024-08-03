<?php
    session_start();
    include_once('../database/conexao.php');
    $idP = $_GET['p'];
    if(empty($idP)){
        header('location: ../index.php');
    }
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
        $r = $sql->fetch_assoc();
        $idSession = $r['id'];
    }
 
    $sql = mysqli_query($conexao, "SELECT * FROM products WHERE idProduct = $idP");
    if(mysqli_num_rows($sql) == 0){
        header('location: ../index.php');
    }
    $sql = mysqli_query($conexao, "SELECT *, date_format(productcreate, '%d/%m/%Y') FROM products WHERE idProduct = $idP");
    $r = $sql->fetch_assoc();
    $nomeP = $r['nomeProduct'];
    $donoP = $r['ownerProduct'];
    $photoP = $r['photoProduct'];
    $descricaoP = $r['descricao'];
    $preco = $r['price'];
    $precoP = number_format($preco, 2, ',', '.');
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
    <link rel="stylesheet" href="../classes.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <script src="../jquery-3.7.1.js"></script>
    <script src="produto.js"></script>
    <title><?php echo $nomeP ?></title>
</head>
<body>
    <header>
        <a href="../index.php" class="icon-a">
            <img src="../assets/icone.ico" alt="" class="icon">
        </a>
        <div class="header_1">
            <a href='../promotions/promotions.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Promoções'></a>
            <?php
                if(isset($_SESSION['email'])){
                    echo "
                    <a href='../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
                    <a href='../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
                    <a href='../criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
                    <a href='../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
                    <a href='../loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
                        ";
                }
            ?>
        </div>
        <?php 
            if(isset($_SESSION['email'])){
                echo "<div class='header_2'>
                        <a href='../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
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
                <a href='<?php echo "../loja/profile.php?l=$idUser" ?>' class="line-of-options"><?php echo $nomeUser ?></a>
                <h1>Preço</h1>
                <p>R$ <?php echo $precoP ?></p>
                <a class="btn-buy">Comprar</a>
                <?php 
                    if(isset($_SESSION['email'])){
                        $sql = mysqli_query($conexao, "SELECT * FROM carrinho WHERE idProduto = $idP AND idUser = $idSession");
                        if(mysqli_num_rows($sql) == 0){
                            echo "
                                <input type='button' class='btn-car' value='Adicionar ao Carrinho'>
                                ";
                        } else {
                            echo "
                                <input type='button' class='btn-car' value='Retirar do Carrinho'>
                            ";
                        }
                    }
                    $sql = mysqli_query($conexao, "SELECT * FROM admin WHERE admin = $idSession");
                    if(mysqli_num_rows($sql) > 0){
                        echo "<input type='submit' name='delete' class='btn-delete' value='Apagar Produto'>";
                    }
                ?>
            </div>
        </section>
    </main>
</body>
</html>