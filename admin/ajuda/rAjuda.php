<?php
    session_start();
    include_once('../../database/conexao.php');
    if(!isset($_GET['a'])){
        header('location: ../../index.php');
    }
    // 
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    //
    $idA = $_GET['a'];
    $sql = mysqli_query($conexao, "SELECT *, date_format(timeAjuda, '%d/%m/%Y') FROM ajuda WHERE idAjuda = $idA");
    if(mysqli_num_rows($sql) == 0){
        header('location: ../index.php');
    } 
    // 
    $r = $sql->fetch_assoc();
    $title = $r['titleAjuda'];
    $idUserAjuda = $r['idUserAjuda'];
    $ajuda = $r['ajuda'];
    $timeAjuda = $r["date_format(timeAjuda, '%d/%m/%Y')"];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE id = $idUserAjuda");
    $r = $sql->fetch_assoc();
    $nomeUser = $r['nome'];

    if(isset($_POST['submit'])){
        $resposta = $_POST['response'];
        if(strlen($resposta) > 3 && strlen($resposta) < 300){
            $sql = mysqli_query($conexao, "INSERT INTO rajuda VALUES (DEFAULT, $idSession, '$resposta', $idA, DEFAULT)");
            if($sql){
                $sql = mysqli_query($conexao, "UPDATE ajuda SET status = 'Respondido' WHERE idAjuda = $idA");
                header('location: ../ajuda.php');
            }
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
    <script src="ajuda.js"></script>
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="ajuda.css">
    <title><?php echo $title ?></title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href='../../index.php' class="icon-a">
                <img src="../../assets/icone.ico" class="icon">
            </a>
            <a href='../../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
            <a href='../../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
            <a href='../../criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
            <a href='../../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
        </div>
    </header>
    <main>
        <div class="box-div">
            <p class='nome'>
                <?php echo $nomeUser ?>
                
            </p>
            <p class="time"> <?php echo $timeAjuda ?> </p>
            <h1>
                <?php echo $title ?>
            </h1>
            <span>
                <?php echo $ajuda ?>
            </span>
        </div>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM rajuda WHERE idPost = $idA");
            while ($r = $sql->fetch_assoc()){
                $rResp = $r['resposta'];
                $rTime = $r['time'];
                $idAdmin = $r['idStaff'];
                $sql = mysqli_query($conexao, "SELECT nome FROM users WHERE id = $idAdmin");
                $i = $sql->fetch_assoc();
                $nome = $i['nome'];
                echo "
                    <div class='box-div'>
                        <p class='nome'>
                            $nome
                        </p>
                        <p class='time'> $rTime </p>
                        <span>
                            $rResp
                        </span>
                    </div>
                 ";
            }
        ?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <textarea name="response" id="response" placeholder="Digite sua resposta"></textarea>
            <button type="submit" name="submit">Enviar</button>
        </form>  
    </main>    
</body>
</html>