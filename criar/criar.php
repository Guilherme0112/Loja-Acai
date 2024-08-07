<?php
    session_start();
    include_once('../database/conexao.php');
    if(!isset($_SESSION['email'])){
        header('location: ../index.php');
    }

    function nomePhoto($nameEncripty){
        $tamanhoString = 20;
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nameEncripty = '';

        for ($i = 0; $i < $tamanhoString; $i++) {
            $nameEncripty .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
        return $nameEncripty;
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
        if(strlen($nome) > 2 && strlen($nome) < 50 && isset($_FILES['photo']['name']) && strlen($descricao) < 301 && is_numeric($preco)){
            $photo = $_FILES['photo']['name'];
            $ext = pathinfo($photo, PATHINFO_EXTENSION);
            //
            $preco = str_replace(",", ".", $preco);
            $newPhoto = nomePhoto($newPhoto);
            $newRoute = "database/arquivos/$idSession/$newPhoto." . $ext;

            $mover = move_uploaded_file($_FILES['photo']['tmp_name'], "../$newRoute");
            if($mover){
                $sql = mysqli_query($conexao, "INSERT INTO products VALUES (default, '$nome', $idSession, '$newRoute', '$descricao', $preco, default)");
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
            <a href="../index.php" class="icon-a">
                <img src="../assets/icone.ico" alt="" class="icon">
            </a>
            <a href='../pedidos/pedidos.php' class='fa-solid fa-box' title='Pedidos'></a>
            <a href='../produto/meus-produtos/meusprodutos.php' class='fa-solid fa-bag-shopping' style='color: white;' title='Meus Produtos'></a>
            <a href='../config/config.php' class='fa-solid fa-gear' style='color: white;' title='Configurações'></a>
            <a href='../loja/carrinho.php' class='fa-solid fa-cart-shopping' title='Carrinho'></a>
        </div>
        <div class="header_2">
            <a href='../loja/loja.php' title='Perfil' class='fa-solid fa-circle-user'></a>
            <a href='../login/logout.php' title='Sair' class='fa-solid fa-right-from-bracket'></a>
        </div>
    </header>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onsubmit="return vali()">
        <label for="nome">Nome do Produto: *</label>
        <input type="text" name="nome" id="nome" class="input" placeholder="Ex: Pote de Açaí 2L" required>
        <label for="preco">Preço do Produto: *</label>
        <input type="number" step="0.01" name="preco" class="input" id="preco" placeholder="Ex: 13,99" required>
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