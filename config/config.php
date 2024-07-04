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
    if(isset($_POST['submit'])){
        $nome = $_POST['nome'];
        $tel = $_POST['tel'];
        $cep = $_POST['cep'];
        if(strlen($nome) > 2 && strlen($nome) < 55 && strlen($tel) == 15 && strlen($cep) == 9){
            $sql = mysqli_query($conexao, "SELECT nome FROM users WHERE nome = '$nome'");
            if(mysqli_num_rows($sql) == 0){
                $sql = mysqli_query($conexao, "UPDATE users SET nome = '$nome' WHERE id = $idSession");
            }
            $sql = mysqli_query($conexao, "SELECT tel FROM users WHERE tel = '$tel'");
            if(mysqli_num_rows($sql) == 0){
                $sql = mysqli_query($conexao, "UPDATE users SET tel = '$tel' WHERE id = $idSession");
            }
            $sql = mysqli_query($conexao, "SELECT cep FROM users WHERE cep = '$cep'");
            if(mysqli_num_rows($sql) == 0){
                $sql = mysqli_query($conexao, "UPDATE users SET cep = '$cep' WHERE id = $idSession");
            }
        }
        header('location: ../loja/loja.php');
    }
    if(isset($_POST['delete'])){
        $sql = mysqli_query($conexao, "SELECT * FROM info WHERE idUser = $idSession");
        if(mysqli_num_rows($sql) > 0){
            $delete = mysqli_query($conexao, "DELETE FROM info WHERE idUser = $idSession");
        }
        $sql = mysqli_query($conexao, "SELECT * FROM products WHERE ownerProduct = $idSession");
        if(mysqli_num_rows($sql) > 0){
            $delete = mysqli_query($conexao, "DELETE FROM products WHERE ownerProduct = $idSession");
        }
        $sql = mysqli_query($conexao, "SELECT * FROM carrinho WHERE idUser = $idSession");
        if(mysqli_num_rows($sql) > 0){
            $delete = mysqli_query($conexao, "DELETE FROM carrinho WHERE idUser = $idSession");
        }
        rmdir("../database/arquivos/$idSession");
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
        <a href="../index.php" class="icon-a">
            <img src="../assets/icone.ico" class="icon">
        </a>
        <div class="header_1">
            <a href='../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
            <a href='../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
            <a href='../criar/criar.php' class='fa-solid fa-folder-plus' style='color: white;' title='Criar Produto'></a>
            <a href='../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
            <a href='../loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
        </div>
        <div class="header_2">
            <a href='../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
            <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <main>
        <section class="photoProfile">
            <img src="<?php  echo $photoSession ?>" class="img-profile">
            <p><?php echo $nomeSession ?></p>
            <a href="editar/photo.php" class="btn">Editar Foto de perfil</a>
        </section>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="config" onsubmit="return vali()">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $nomeSession ?>" id="nome">
            <br>
            <label for="tel">Telefone:</label>
            <input type="tel" name="tel" id="tel" maxlength="15" value="<?php echo $telSession ?>">
            <br>
            <label for="cep">CEP:</label>
            <input type="text" name="cep" id='cep' maxlength="9" value="<?php echo $cepSession ?>">
            <br>
            <label for="nome">E-mail:</label>
            <input type="email" name="email" value="<?php echo $email ?>" disabled>
            <button type="submit" name="submit" class="btn">Salvar Alterações</button>
            <a href="editar/password.php" class="btn">Trocar de Senha</a>
            <a href="informacoes/info.php" class="btn">Informações de Endereço</a>
            <br>
            <button type="submit" name="delete" id='delete' class="btn btn-delete">Excluir Conta</button>
        </form>
    </main>
    </body>
</html>