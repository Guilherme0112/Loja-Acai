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
    <link rel="stylesheet" href="../../classes.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="ajuda.css">
    <script src="ajuda.js"></script>
    <title>Ajuda - Admin</title>
</head>
<body>
    <header>
        <div class="header_1">
            <a href="../../index.php" class="icon-a">
                <img src="../../assets/icone.ico" class="icon">
            </a>
            <a href='../../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
            <a href='../admin.php' class='fa-solid fa-user-tie' title='Adminstradores'></a>
        </div>
    </header>
    <section class="section">

    </section>
    <main>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM ajuda WHERE status = 'Não Respondido'");
            if(mysqli_num_rows($sql) > 0){
                while($i = $sql->fetch_assoc()){
                    $idAjuda = $i['idAjuda'];
                    $idUserAjuda = $i['idUserAjuda'];
                    $titleAjuda = $i['titleAjuda'];
                    $ajuda = $i['ajuda'];
                    $timeAjuda = $i['timeAjuda'];
                    $statusAjuda = $i['status'];
                    echo "
                            <a href='rAjuda.php?a=$idAjuda' class='box-ajuda'>
                                <p>$titleAjuda</p>
                                <span>$statusAjuda</span>
                            </a>
                        ";
                }

            } else{

                echo "<p class='msg-product'> 
                        Não tem ajudas pendentes
                    </p>";
            }
            
        ?>
        <span style="outline: 1px solid white; width: 100%; margin: 10px 0;"></span>
        <?php
            $sql = mysqli_query($conexao, "SELECT * FROM ajuda WHERE status = 'Respondido'");
            if(mysqli_num_rows($sql) > 0){
                while($i = $sql->fetch_assoc()){
                    $idAjuda = $i['idAjuda'];
                    $idUserAjuda = $i['idUserAjuda'];
                    $titleAjuda = $i['titleAjuda'];
                    $ajuda = $i['ajuda'];
                    $timeAjuda = $i['timeAjuda'];
                    $statusAjuda = $i['status'];
                    echo "
                            <a href='rAjuda.php?a=$idAjuda' class='box-ajuda'>
                                <p>$titleAjuda</p>
                                <span>$statusAjuda</span>
                            </a>
                        ";
                }

            } else{

                echo "<p class='msg-product'> 
                        Não tem ajudas pendentes
                    </p>";
            }
            
        ?>
    </main>
</body>
</html>