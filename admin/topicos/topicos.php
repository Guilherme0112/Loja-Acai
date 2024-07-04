<?php
    session_start();
    include_once('../../database/conexao.php');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../classes.css">
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="topicos.css">
    <script src="topicos.js"></script>
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <title>Tópicos - Admin</title>
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
        <?php 
            $sql = mysqli_query($conexao, "SELECT * FROM topico");
            if(mysqli_num_rows($sql) > 0){
                while($i = $sql->fetch_assoc()){
                    $idT = $i['idTopico'];
                    $titleT = $i['titleT'];
                    $topico = $i['topico'];
                    echo "
                        <div class='box'> 
                            <h3 style='text-align: center;'>$titleT</h3>
                            <p style='text-align: center; padding: 10px;'>$topico</p>
                            <div class='button-size'>
                                <a href='' class='button'>Editar</a>
                            </div>
                        </div>
                ";
                }
            } else {
                echo "";
            }
        ?>
    </main>
</body>
</html>