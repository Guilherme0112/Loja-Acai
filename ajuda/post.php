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
    if(!isset($_GET['a']) || empty($_GET['a'])){
        header('location: ../index.php');
    }
    $idA = $_GET['a'];
    $sql = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idAjuda = $idA");
    if(mysqli_num_rows($sql) > 0){
        $r = $sql->fetch_assoc();
        $titleAjuda = $r['titleAjuda'];
        $ajuda = $r['ajuda'];
        $time = $r["date_format(timeAjuda, '%d/%m/%Y')"];
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ajuda.css">
    <link rel="stylesheet" href="../classes.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <title><?php echo $titleAjuda ?></title>
</head>
<body>
    <header>
        <a href="../index.php" class="icon-a">
            <img src="../assets/icone.ico" class="icon">
        </a>
    </header>
    <main>
        <div class='box-div'>
            <h3 class='nome'>
                <?php echo $titleAjuda ?>
            </h3>
            <p class='time'> <?php echo $time ?> </p>
            <span>
                <?php echo $ajuda ?>
            </span>
        </div>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM rajuda WHERE idStaff = $idSession");
            if(mysqli_num_rows($sql) > 0){
                while($i = $sql->fetch_assoc()){
                    $resposta = $i['resposta'];
                }
            }
        ?>
    </main>
</body>
</html>