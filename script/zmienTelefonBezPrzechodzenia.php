<?php
    session_start();
    if (empty($_SESSION['user'])){
        header("Location: http://localhost/sites/login.php");
        exit;
    }else{

        $connect=mysqli_connect("localhost","root","","sklep");
        $user =  $_SESSION['user'];
        $telefon = $_POST['telefon'];
        $query = "UPDATE user SET telefon = $telefon WHERE login = '$user'";
        $connect->query($query);
        
    }
    