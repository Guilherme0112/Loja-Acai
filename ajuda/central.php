<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../idnex.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../classes.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="ajuda.css">
    <title>Central de Ajuda</title>
</head>
<body>
    <header>
        <a href="../index.php" class="icon-a">
            <img src="../assets/icone.ico" class="icon">
        </a>
    </header>
    <main>
        <a href='ajuda.php' class="box-help">
            <i class="fa-solid fa-plus icon-admin"></i>
            <p>Criar Ajuda</p>
        </a>
        <?php
            $sql = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idUserAjuda = $idSession");
            if(mysqli_num_rows($sql) > 0){
                while($i = $sql->fetch_assoc()){
                    $idAjuda = $i['idAjuda'];
                    $title = $i['titleAjuda'];
                    $time = $i["date_format(timeAjuda, '%d/%m/%Y')"];
                    echo "
                        <a href='post.php?a=$idAjuda' class='box-ajuda'>
                            <p>$title</p>
                            <span>$time</span>
                        </a>
                    ";
                }
            } 
            
        ?>  
    </main>
</body>
</html>