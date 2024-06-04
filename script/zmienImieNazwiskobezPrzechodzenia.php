<?php
    session_start();
    if (empty($_SESSION['user'])){
        header("Location: http://localhost/sites/login.php");
        exit;
    }else{

        $connect=mysqli_connect("localhost","root","","sklep");
        $user =  $_SESSION['user'];
        $imie = $_POST['imie'];
        $imie = $_POST['nazwisko'];
        $query = "UPDATE user SET imie = $imie, nazwisko = $nazwisko WHERE login = '$user'";
        $connect->query($query);
        
    }
    