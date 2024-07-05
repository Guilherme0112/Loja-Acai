<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $resp = $sql->fetch_assoc();
    $idSession = $resp['id'];

    $total = 0.00;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loja.css">
    <link rel="stylesheet" href="../classes.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <script src="../jquery-3.7.1.js"></script>
    <script src="loja.js"></script>
    <title>Carrinho</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php" class="icon-a">
                <img src="../assets/icone.ico" alt="" class="icon">
            </a>
            <a href='../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
            <a href='../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
            <a href='../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
        </div>
        <div class='header_2'>
            <a href='../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
            <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT p.nomeProduct, p.photoProduct, p.price, p.ownerProduct, p.idProduct FROM carrinho JOIN products as p WHERE idUser = $idSession AND idProduto = p.idProduct;");
            if(mysqli_num_rows($sql) == 0){
                echo "<p class='msg-product'>
                        Você não tem produtos no carrinho
                    </p>"; 
            } else { 
                while($i = $sql->fetch_assoc()){
                    $idP = $i['idProduct'];
                    $photoP = $i['photoProduct'];
                    $preco = $i['price'];
                    $nomeP = $i['nomeProduct'];
                    $exPreco = number_format(((17/100) * $preco) + $preco, 2);

                    echo "
                        <div class='box-p'>
                            <input type='text' id='idP' style='display: none;' data-comment-id='$idP'>
                            <img src='../$photoP' class='photo'>
                            <a href='../produto/produto.php?p=$idP' class='nome-p line-of-options'>$nomeP</a>
                            <p class='preco-p'>R$ $preco</p>
                        </div>";

                        $total = $total + $preco;
                        $totalF = number_format($total, 2, ',', '.');
                }
            }
        ?>
    </main>
    <footer>
        <div>
            <p>Total:</p>
            <?php 
                if(isset($totalF)){
                    echo "R$" . $totalF;
                } else {
                    echo '0,00';
                }
             ?>
        </div>
        <div>
            <button class="btn-buy">Comprar</button>
        </div>
    </footer>
</body>
</html>
