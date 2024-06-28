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
    if(isset($_POST['submit'])){
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $photo = $_FILES['photo']['name'];
        if(strlen($nome) > 2 && strlen($nome) < 50 && isset($_FILES['photo']['name']) && strlen($descricao) < 301){
            $photo = $_FILES['photo']['name'];
            $routePhoto = "../database/arquivos/$idSession/$photo";
            $mover = move_uploaded_file($_FILES['photo']['tmp_name'], "$routePhoto");
            $route = "database/arquivos/$idSession/$photo";
            if($mover){
                $sql = mysqli_query($conexao, "INSERT INTO products VALUES (default, '$nome', $idSession, '$route', '$descricao', $preco, default)");
                if($sql){
                    header('location: ../loja/loja.php');
                }
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="criar.css">
    <script src="criar.js"></script>
    <link rel="stylesheet" href="../classes.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <title>Criar Produto</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../index.php">
                <img src="../assets/icone.ico" alt="" class="icon">
            </a>
            <a href="../loja/loja.php" class="line-of-options">Sua Loja</a>
        </div>
    </header>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return vali()">
        <label for="nome">Nome do Produto: *</label>
        <input type="text" name="nome" id="nome" class="input" placeholder="Ex: Pote de Açaí 2L" required>
        <label for="preco">Preço do Produto: *</label>
        <input type="number" name="preco" class="input" id="preco" step="0.010" placeholder="Ex: 13,99" required>
        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" name='descricao' class="input"></textarea>
        <label for="photo" id="labelPhoto">Foto do Produto: *</label>
        <input type="file" name="photo" id="photo" class="input" required>
        <span style="width: 100%;"></span>
        <img id="img">
        <span style="width: 100%;"></span>
        <input type="submit" name='submit' value="Enviar">
    </form>
    <footer></footer>
</body>
</html>