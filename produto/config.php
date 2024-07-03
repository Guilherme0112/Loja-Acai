<?php
    session_start();
    include_once('../database/conexao.php');
    $email = $_SESSION['email'];
    $sql = mysqli_query($conexao, "SELECT * FROM users WHERE email = '$email'");
    $r = $sql->fetch_assoc();
    $idSession = $r['id'];


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['produto'])){
            $produto = $_POST['produto'];
            $sql = mysqli_query($conexao, "SELECT * FROM products WHERE idProduct = $produto");
            if(mysqli_num_rows($sql) > 0){
                $sql = mysqli_query($conexao, "SELECT * FROM carrinho WHERE idProduto = $produto AND idUser = $idSession");
                if(mysqli_num_rows($sql) == 0){
                    $sql = mysqli_query($conexao, "INSERT INTO carrinho VALUES (default, $idSession, $produto)");
                } else {
                    $sql = mysqli_query($conexao, "DELETE FROM carrinho WHERE idProduto = $produto AND idUser = $idSession");
                }
            }
        }
    }
?>