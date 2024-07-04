<?php
    session_start();
    include_once('database/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Açaí Store</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="classes.css">
    <script src="scripts.js"></script>
    <link rel="stylesheet" href="fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="assets/icone.ico" type="image/x-icon">
</head>
<body>
    <header>
        <div class="header_1">
            <a href="index.php" class="icon-a">
                <img src="assets/icone.ico" alt="" class="icon">
            </a>
            <a href="promotions/promotions.php" class="fa-solid fa-fire-flame-curved" style="color: white;"></a>
            <?php
                if(isset($_SESSION['email'])){
                    echo "
                    <a href='pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
                    <a href='produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
                    <a href='criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
                    <a href='config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
                    <a href='loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
                        ";
                }
            ?>
            <a href="" class="fa-solid fa-question" style="color: white;"></a>
        </div>
        <?php 
            if(isset($_SESSION['email'])){
                echo "<div class='header_2'>
                        <a href='loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
                        <a href='login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
                    </div>";
            } else {

                echo "<div class='header_2'>
                        <a href='login/login.php' title='Login' class='fa-solid fa-user'></a>
                    </div>";
            }
            
        ?>
    </header>

    <!-- background 1 e button -->

    <main>
        <section id="background_1"></section>
    </main>

    <!-- Box of buy -->

    <section id="help-in-search">
        <h2 class="title">Produtos que talvez você goste!</h2>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM products ORDER BY RAND() LIMIT 8");
            while($i = $sql->fetch_assoc()){
                $idP = $i['idProduct'];
                $nomeP = $i['nomeProduct'];
                $preco = $i['price'];
                $precoP = number_format($preco, 2, ',', '.');
                $photoP = $i['photoProduct'];
                $exPreco = number_format(((17/100) * $preco) + $preco, 2, ',', '.');

                echo "<a href='produto/produto.php?p=$idP' class='box'>
                    <img src='$photoP' class='img'>
                    <p class='title-box line-of-options'>$nomeP</p>
                    <span class='preco'>
                        <del class='ex-preco'>R$ $exPreco</del>
                        R$ $precoP
                    </span>
                </a>";
            }
            

        ?>
            
    </section>
    <section class="best-stores">
        <h2 class="title">Melhores lojas</h2>
        <?php 
            $sql = mysqli_query($conexao, "SELECT distinct p.ownerProduct, nome, u.photoProfile  FROM users AS u JOIN products AS p WHERE id = p.ownerProduct ORDER BY RAND() LIMIT 6;");
            while($r = $sql->fetch_assoc()){
                $idUser = $r['ownerProduct'];
                $photoProfile = $r['photoProfile'];
                $photoProfile = substr($photoProfile, 3);
                $nomeUser = $r['nome'];
                echo "
                <a href='loja/profile.php?l=$idUser' class='box-stores' title='$nomeUser'>
                    <img src='$photoProfile' class='img-box-store'>
                </a>
                ";
            }
        ?>
    </section>
    <section class="novidades">
        <h2 class="title">Novidades para você!</h2>
        <div class="box-nov">
            <p>Frete Grátis</p>
            <span class="fa-solid fa-truck"></span>
        </div>
        <div class="box-nov">
            <p>Entrega mais rápidas!</p>
            <span class="fa-solid fa-bolt"></span>
        </div>
        <div class="box-nov">
            <p>Muito mais gostoso!</p>
            <span class="fa-solid fa-bowl-food"></span>
        </div>
    </section>
    <section class="info">
        <h2 class="title">Tópicos</h2>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM topico ORDER BY RAND() LIMIT 4");
            while($r = $sql->fetch_assoc()){
                $idT = $r['idTopico'];
                $titleT = $r['titleT'];
                $topico = $r['topico'];

                echo "
                    <div class='box'> 
                        <h3 style='text-align: center;'>$titleT</h3>
                        <p style='text-align: center; padding: 10px;'>$topico</p>
                        <div class='button-size'>
                            <a href='' class='button'>Veja mais</a>
                        </div>
                    </div>
                ";

            }
        ?>
    </section>
    <footer>
        <div id="opcoes">
            <a href="" class="line-of-options" style="color: white;"><b>Quem somos?</b></a>
            <a href="" class="line-of-options" style="color: white;"><b>Suporte</b></a>
            <a href="" class="line-of-options" style="color: white;"><b>WhatsApp</b></a>
            <a href="" class="line-of-options" style="color: white;"><b>Instagram</b></a>
        </div>
    </footer>
</body>

</html>