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
            <a href="../../index.php" class="icon-a">
                <img src="../../assets/icone.ico" alt="" class="icon">
            </a>
            <a href='../../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
            <a href='../../criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
            <a href='../../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
            <a href='../../loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
        </div>
        <div class='header_2'>
            <a href='../../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
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
                    $preco = $i['price'];
                    $precoP = number_format($preco, 2, ',', '.');
                    $photoP = $i['photoProduct'];
                    $exPreco = number_format(((17/100) * $preco) + $preco, 2);
                    
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