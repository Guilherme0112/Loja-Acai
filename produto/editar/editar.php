<?php
    session_start();
    include_once('../../database/conexao.php');
    if(!isset($_SESSION['email']) || empty($_GET['p'])){
        header('location: ../../index.php');
    }

    function nomePhoto($nameEncripty){
        $tamanhoString = 20;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nameEncripty = '';

        for ($i = 0; $i < $tamanhoString; $i++) {
            $nameEncripty .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $nameEncripty;
    }

    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    //
    $idP = $_GET['p'];
    $sql = mysqli_query($conexao, "SELECT * FROM products WHERE idProduct = $idP");
    if(mysqli_num_rows($sql) == 0){
        header('location: ../../index.php');
    }
    $r = $sql->fetch_assoc();
    $ownerP = $r['ownerProduct'];
    if($idSession != $ownerP){
        header('location: ../../index.php');
    }
    $precoP = $r['price'];
    $nomeP = $r['nomeProduct'];
    $descricao = $r['descricao'];
    $photoP = $r['photoProduct'];

    if(isset($_POST['submit'])){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $photo = $_FILES['photo']['name'];
        if(strlen($nome) > 2 && strlen($nome) < 50){
            $nome = mysqli_escape_string($conexao, $nome);
            $sql = mysqli_query($conexao, "UPDATE products SET nomeProduct = '$nome' WHERE idProduct = $idP");
        }
        if(isset($_FILES['photo']['name']) ){
            if(file_exists("../../$photoP")){
                unlink("../../$photoP");
            }
            $photo = $_FILES['photo']['name'];
            $ext = pathinfo($photo, PATHINFO_EXTENSION);

            $newPhoto = nomePhoto($newPhoto);
            $route = "database/arquivos/$idSession/$newPhoto." . $ext;
            $mover = move_uploaded_file($_FILES['photo']['tmp_name'], "../../$route");
            if($mover){
                $sql = mysqli_query($conexao, "UPDATE products SET photoProduct = '$route' WHERE idProduct = $idP");
            }
        }
        if(isset($preco)){
            $sql = mysqli_query($conexao, "UPDATE products SET price = $preco WHERE idProduct = $idP");
        }
        if(strlen($descricao) < 301){
            $descricao = mysqli_escape_string($conexao, $descricao);
            $sql = mysqli_query($conexao, "UPDATE products SET descricao = '$descricao' WHERE idProduct = $idP");
        }
        header('location: ../meus-produtos/meusprodutos.php');
    }
    if(isset($_POST['delete'])){
        if(file_exists("../../$photoP")){
            unlink("../../$photoP");
        }
        $sql = mysqli_query($conexao, "DELETE FROM products WHERE idProduct = $idP");
        if($sql){
            header('location: ../meus-produtos/meusprodutos.php');
        }
    };
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="editar.css">
    <link rel="stylesheet" href="../../classes.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <script src="editar.js"></script>
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <title>Editar Produtos</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../../index.php" class="icon-a">
                <img src="../../assets/icone.ico" alt="" class="icon">
            </a>
            <a href="../../loja/loja.php" class="fa-solid fa-circle-user" style="color: white;" title="Minha Loja"></a>
            <a href="../../criar/criar.php" class="fa-solid fa-folder-plus" style="color: white;" title="Criar Produto"></a>
            <a href="../../config/config.php" class="fa-solid fa-gear" style="color: white;"></a>
        </div>
        <div class='header_2'>
            <a href='../../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return vali()">
            <label for="nome">Nome do Produto: *</label>
            <input type="text" name="nome" id="nome" class="input" value="<?php echo $nomeP ?>">
            <label for="preco">Preço do Produto: *</label>
            <input type="number" name="preco" class="input" id="preco"  value="<?php echo $precoP ?>" step="0.010">
            <label for="descricao">Descrição</label>
            <textarea name="descricao" id="descricao" name='descricao' value="<?php echo $descricao ?>" class="input"></textarea>
            <label for="photo" id="labelPhoto">Foto do Produto: *</label>
            <input type="file" name="photo" id="photo" class="input">
            <span style="width: 100%;"></span>
            <img id="img" src="<?php echo "../../$photoP" ?>">
            <span style="width: 100%;"></span>
            <input type="submit" name='submit' value="Enviar">
            <input type="submit" name="delete" id='delete' value="Apagar Produto">
        </form>
    </main>
</body>
</html>