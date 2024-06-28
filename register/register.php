<?php
    session_start();
    include_once('../database/conexao.php');
    if(isset($_SESSION['email'])){
        header('location: ../index.php');
    }
        $name = '';
        $phone = '';
        $cep = '';
        $email = '';

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $cep = $_POST['cep'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
        if(mysqli_num_rows($sql) == 0){
            if(strlen($name) > 2 && strlen($name) < 55 && strlen($phone) == 12 && strlen($cep) == 9 && isset($email) && strlen($pass) > 3 && strlen($pass) <= 16){
                $sql = mysqli_query($conexao, "INSERT INTO users VALUES (DEFAULT, '$name', '$phone', '$cep', '$email', '$pass', DEFAULT)");
                $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
                $res = $sql->fetch_assoc();
                $idSession = $res['id'];
                $dir = "../database/arquivos/$idSession/";
                mkdir($dir, 0777, true);
                header('location: ../login/login.php');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar uma Conta</title>
    <link rel="stylesheet" href="register.css">
    <script src="register.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-6.5.1-web/css/all.min.css">
    <link rel="shortcut icon" href="../assets/icone.ico" type="image/x-icon">
</head>
<body>
    <main>
        <section id='img'></section>
        <section>
            <div>
                <button id='back' onclick="back()" title='Voltar'><</button>
            </div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method='POST' onsubmit="return vali()">
                <label for="name">Nome</label>
                <input type="text" name='name' id='name' value="<?php echo $name ?>" maxlength="50" required>
                <p class="error" id="msgName"></p>
                <label for="phone">Telefone</label>
                <input type="text" name="phone" id="phone" value="<?php echo $phone ?>" maxlength="12" required>
                <p class="error" id="msgPhone"></p>
                <label for="cep">CEP</label>
                <input type="text" name="cep" id="cep" value="<?php echo $cep ?>" maxlength="9" required>
                <p class="error" id="msgCep"></p>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?php echo $email ?>" required>
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" maxlength="16" required>
                <p class="error" id="msgPass"></p>
                <a href="../login/login.php">Já tenho conta</a>
                <button type="submit" name="submit">Criar conta</button>
                <a href="https://buscadecep.net" target="_blank" id="no-cep">Não sei meu CEP</a>
            </form>
        </section>
    </main>
</body>
</html>