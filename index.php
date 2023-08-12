<?php session_start() ?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RH</title>
    <link rel="stylesheet" href="assets/style.css">

</head>

<body>
    <?php
include('./confs/confi.php');
if (!isset($_SESSION['login'])) {
        if (isset($_POST['user'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $sql = $pdo->prepare("select * from user");
            $sql->execute();
            $values = $sql->fetchAll();
            foreach ($values as $key => $value) {
                $_SESSION['login'] = $value['id'];
               if ($nome == $value['nome'] && $email == $value['email']) {
                    $_SESSION['login'] = $value['id'];
                    header('Location:index.php');
                }
            }
        }
        if (isset($_POST['ADM'])) {
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            if ($email == "Admin@gmail.com" && $pass == 1234) {
                header('Location:Admin');
            }
        }
        include('login.html');
    } else {
        if (isset($_GET['logout'])) {
            unset($_SESSION['login']);
            session_destroy();
            header('location:index.php');
        }
        include("user/index.php");
    }

    ?>
</body>

</html>