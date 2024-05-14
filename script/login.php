<?php
    session_start();
    $connect=mysqli_connect("localhost","root","","sklep");
    
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT login, haslo FROM user WHERE login = '$login' OR email = '$login'";

    $result = $connect->query($query);
    if(mysqli_num_rows($result) == 0){
        header("Location: http://localhost/sites/login.php");
        exit;
    }else{
        $result = $result->fetch_object();
        $login = $result->login;
        $hash = $result->haslo;
        if(password_verify($password,$hash)){
            $_SESSION['user'] = htmlspecialchars($login);
            header("Location: http://localhost/sites/index.php");
            exit;
        }else{
            header("Location: http://localhost/sites/login.php");
            exit;
        }

    }
    