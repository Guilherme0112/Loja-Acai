<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../index.php');
    }
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];
    $photoSession = $r['photoProfile'];
    $nomeSession = $r['nome'];
    $cepSession = $r['cep'];
    $telSession = $r['tel'];
    if(isset($_POST['delete'])){
        $delete = mysqli_query($conexao, "DELETE FROM users WHERE id = $idSession");
        if($delete){
            unset($_SESSION['email']);
            unset($_SESSION['pass']);
            header('location: ../login/login.php');
        }
    }
?>  
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="config.css">
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="stylesheet" href="../classes.css">
    <script src="config.js"></script>
    <title>Configurações</title>
</head>
<body>
    <header>
        <a href="../index.php">
            <img src="../assets/icone.ico" class="icon">
        </a>
        <div class="header_1">
            <a href="../promotions/promotions.php" class="line-of-options" style="color: white;">Promoções</a>
            <a href="../loja/loja.php" class="line-of-options" style="color: white;">Minha Loja</a>
            <a href="" class="line-of-options" style="color: white;">Ajuda</a>
        </div>
        <?php 
            if(isset($_SESSION['email'])){
                echo "<div class='header_2'>
                        <a href='../loja/loja.php' title='Seu Perfil' class='fa-solid fa-user'></a>
                        <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
                    </div>";
            } else {

                echo "<div class='header_2'>
                        <a href='../login/login.php' title='Login' class='fa-solid fa-user'></a>
                    </div>";
            }
            
        ?>
    </header>
    <main>
        <section class="photoProfile">
            <img src="<?php  echo $photoSession ?>" class="img-profile">
            <p><?php echo $nomeSession ?></p>
            <a href="edit/password.php" class="btn">Editar Foto de perfil</a>
        </section>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="config">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $nomeSession ?>">
            <br>
            <label for="tel">Telefone:</label>
            <input type="tel" name="tel" id="tel" maxlength="15" value="<?php echo $telSession ?>">
            <br>
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id='cep' maxlength="9" value="<?php echo $cepSession ?>">
            <br>
            <label for="nome">E-mail:</label>
            <input type="email" name="email" value="<?php echo $email ?>" disabled>
            <a href="editar/password.php" class="btn">Trocar de Senha</a>
            <a href="informacoes/info.php" class="btn">Preencher Informações</a>
            <br>
            <button type="submit" name="delete" id='delete' class="btn btn-delete">Excluir Conta</button>
        </form>
    </main>
    </body>
</html>