<?php
    $connect=mysqli_connect("localhost","root","","sklep");

    $password = $_POST['password'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $err = array();
    $query = "SELECT count(*) as liczba FROM user WHERE login = '$login'";
    if($connect->query($query)->fetch_object()->liczba){
        $err[] = "Login zajęty";
    };
    $query = "SELECT count(*) as liczba FROM user WHERE email = '$email'";
    if($connect->query($query)->fetch_object()->liczba){
        $err[] = "Konto z tym adresem e-mail już istnieje";
    };

    

    //Hashowanie hasła
    $hash = password_hash($password, PASSWORD_BCRYPT);
    
    $query = "INSERT INTO user (email, login, haslo) VALUES ('$email', '$login', '$hash')";
    if($err){
        
        foreach($err as $error){
            echo "$error";
        }
        header("Location: http://localhost/sites/register.php");
        exit;
    }else{
        $connect->query($query);
        if($connect->errno == 0){
            header("Location: http://localhost/sites/login.php");
            exit;
        }else{
            header("Location: http://localhost/sites/register.php");
            exit;
        }
        echo "nie ma bledow";
    }
    
