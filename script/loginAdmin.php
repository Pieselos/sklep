<?php
    session_start();
    $connect=mysqli_connect("localhost","root","","sklep");
    
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT login FROM admin WHERE login = '$login' AND password = '$password'";
    $result = $connect->query($query);
    if(mysqli_num_rows($result) == 0){
        header("Location: http://localhost/sites/admin.php");
        exit;
    }else{
        $loginAdmin = $result->fetch_object()->login;
        $_SESSION['admin'] = $loginAdmin;
        header("Location: http://localhost/sites/admin.php");
        exit;
    }
    