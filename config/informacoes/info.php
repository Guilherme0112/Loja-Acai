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

    if(isset($_POST['submit'])){
        $address = $_POST['address'];
        $bairro = $_POST['bairro'];
        $number = $_POST['number'];
        $rua = $_POST['rua'];
        if(strlen($bairro) > 2 && strlen($bairro) < 21 && strlen($number) > 0 && strlen($rua) > 2 && strlen($rua) < 51 && strlen($address) < 201){
            $sql = mysqli_query($conexao, "INSERT INTO info VALUES (default, $idSession, '$address', '$bairro', '$number', '$rua')");
            if($sql){
                header('location: ../../loja/loja.php');
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
    <link rel="stylesheet" href="info.css">
    <link rel="stylesheet" href="../../classes.css">
    <script src="info.js"></script>
    <link rel="stylesheet" href="../../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../../assets/icone.ico" type="image/x-icon">
    <title>Informações Importante</title>
</head>
<body>
    <header>
        <a href="../../index.php">
            <img src="../../assets/icone.ico" class="icon">
        </a>
        <div class="header_1">
            <a href="../../loja/loja.php" class="line-of-options">Minha Loja</a>
        </div>
    </header>
    <main>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return vali()">
            <label for="">Endereço:</label>
            <input type="text" name="address" id="address">
            <p class="error" id="enderecoError">0/200</p>
            <label for="">Bairro: *</label>
            <input type="text" name="bairro" id="bairro" required>
            <p class="error" id="bairroError">0/20</p>
            <label for="number" class="number">Número: *</label>
            <input type="number" name="number" id="number" required>
            <label for="">Rua: *</label>
            <input type="text" name="rua" id="rua" required>
            <p class="error" id="ruaError">0/50</p>
            <button type='submit' id="submit" name="submit">Salvar</button>
        </form>
    </main>
</body>
</html>