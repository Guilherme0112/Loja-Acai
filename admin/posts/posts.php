<?php
    session_start();
    include_once('../../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('locaiton: ../../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    $sql = mysqli_query($conexao, "SELECT * FROM admin WHERE admin = $idSession");
    if(mysqli_num_rows($sql) === 0){
        header('location: ../../index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="posts.css">
    <link rel="stylesheet" href="../../classes.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <script src="posts.js"></script>
    <title>Posts - Admin</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../../index.php" class="icon-a">
                <img src="../../assets/icone.ico" class="icon">
            </a>
            <a href='../admin.php' class='fa-solid fa-user-tie' title='Adminstradores'></a>
        </div>
        <div class="header_2">
            <a href='../../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
            <a href='../../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="number" name="search" placeholder="Digite o id do produto">
            <button type="submit" name="id">Buscar</button>
        </form>
        <?php
            if(isset($_GET['id'])){
                if(isset($_GET['search'])){
                    $idPd = $_GET['search'];
                    if(strlen($idPd) > 0){
                        $sql = mysqli_query($conexao, "SELECT * FROM products WHERE idProduct = $idPd");
                    
                        if(mysqli_num_rows($sql) == 0){

                        } else {
                            while($i = $sql->fetch_assoc()){
                                $idP = $i['idProduct'];
                                $nomeP = $i['nomeProduct'];
                                $preco = $i['price'];
                                $precoP = number_format($preco, 2, ',', '.');
                                $photoP = $i['photoProduct'];
                                $exPreco = number_format(((17/100) * $preco) + $preco, 2, ',', '.');
                
                                echo "<a href='../../produto/produto.php?p=$idP' class='box'>
                                        <img src='../../$photoP' class='img'>
                                        <p  class='title-box line-of-options'>$nomeP</p>
                                        <span class='preco'>
                                            <del class='ex-preco'>R$ $exPreco</del>
                                            R$ $precoP
                                        </span>
                                    </a>";
                            }
                        }
                    }
                }
            }
        ?>
        </main>
</body>
</html>