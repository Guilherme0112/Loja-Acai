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
    if(!isset($_GET['p']) || empty($_GET['p'])){
        header('locaiton: ../../index.php');
    }
    $idT = $_GET['p'];
    $sql = mysqli_query($conexao, "SELECT * FROM topicos WHERE idTopico = $idT");
    if(mysqli_num_rows($sql) == 0){
        header('location: topicos.php');
    }
    $sql = mysqli_query($conexao, "SELECT * FROM topicos WHERE idTopico = $idT");
    if(mysqli_num_rows($sql) > 0){
        $r = $sql->fetch_assoc();
        $title = $r['titleT'];
        $topico = $r['topico'];
        $timeT = $r['timeTopico'];
        $userAdmin = $r['userAdmin'];
    }
    if(isset($_POST['submit'])){
        $titleT = $_POST['title'];
        $topicoT = $_POST['topico'];
        if(strlen($titleT) > 3 && strlen($titleT) < 50){
            $sql = mysqli_query($conexao, "UPDATE topicos SET titleT = '$titleT' WHERE idTopico = $idT");
            if(strlen($topicoT) > 3 && strlen($topicoT) < 300){
                $sql = mysqli_query($conexao, "UPDATE topicos SET topico = '$topicoT'  WHERE idTopico = $idT");
            }
        }
        header('location: topicos.php');
    }
    if(isset($_POST['delete'])){
        $sql = mysqli_query($conexao, "DELETE FROM topicos WHERE idTopico = $idT");
        if($sql){
            header('location: topicos.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../classes.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="topicos.css">
    <script src="topicos.js"></script>
    <title><?php echo $title ?></title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../../index.php" class="icon-a">
                <img src="../../assets/icone.ico" class="icon">
            </a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="title">Título:</label>
            <input type="text" name="title" id="title" value="<?php echo $title ?>">
            <br>
            <label for="topico">Tópico:</label>
            <textarea name="topico" id="topico">
                <?php
                    echo $topico;
                ?>
            </textarea>
            <button type="submit" name='submit' class="btn">Salvar</button>
            <button type="submit" name='delete' class="btn-del">Excluir</button>
        </form>
    </main>
</body>
</html>