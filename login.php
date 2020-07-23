<?php
session_start();
require "config.php";

$_SESSION['lg'] = "";

if(!empty($_POST['email']) && !empty($_POST['senha'])) {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    echo $email;
    echo $senha;

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $sql->bindValue(":email", $email);
    $sql->bindValue(":senha", $senha);
    $sql->execute();

    if($sql->rowCount() > 0) {
        $sql = $sql->fetch();
        $id = $sql['id'];
        $_SESSION['lg'] = $id;
        $ip = $_SERVER['REMOTE_ADDR'];

        $sql = $pdo->prepare("UPDATE usuarios SET ip = :ip WHERE id = :id");
        $sql->bindValue(":ip", $ip);
        $sql->bindValue("id", $id);
        $sql->execute();

        header("Location: index.php");
        exit;
    } else {
        echo "Dados inválidos";
    }
} else {
    echo "Favor inserir as informações corretas";
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <div class="container">
        <form method="POST">
            <h1>Logar</h1>
            <div class="form-group">
                <label for="email">E-mail:<br/></label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="senha">Senha:<br/></label>
                <input type="text" name="senha" id="senha" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary"/>Entrar</button>
        </form>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>