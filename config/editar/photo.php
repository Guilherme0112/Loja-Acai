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
    $photoProfile = $r['photoProfile'];
    if(isset($_POST['submit']) && isset($_FILES['photo']['name'])){
        $photo = $_FILES['photo']['name'];
        $ext = pathinfo($photo, PATHINFO_EXTENSION);
        $route = "../database/arquivos/$idSession/userP." . $ext;
        if($photoProfile != '../assets/user.jpg'){
            unlink("../$photoProfile");
        }
        $mover = move_uploaded_file($_FILES['photo']['tmp_name'], "../$route");
        $sql = mysqli_query($conexao, "UPDATE users SET photoProfile = '$route' WHERE id = $idSession");
        if($mover && $sql){
            header('location: ../../loja/loja.php');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="photo.css">
    <script src="photo.js"></script>
    <link rel="stylesheet" href="../../classes.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <title>Editar Foto de Perfil</title>
</head>
<body>
    <header>
        <a href="../../index.php">
            <img src="../../assets/icone.ico" class="icon">
        </a>
        <div class="header_1">
            <a href="../config.php" class="line-of-options">Editar Perfil</a>
        </div>
    </header>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return vali()" enctype="multipart/form-data">
        <label for="photo" id="label">Adicionar Foto</label>
        <input type="file" name="photo" id="photo" required>
        <img id="img">
        <button class="btn" name="submit">Salvar</button>
    </form>
</body>
</html>