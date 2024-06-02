<?php
    session_start();
    if(empty($_SESSION['user'])){
        header("Location: http://localhost/sites/login.php");
        exit;
    }else{
        $connect=mysqli_connect("localhost","root","","sklep");
        $przesylka = $_POST['przesylka'];
        $platnosc = $_POST['platnosc'];
    }
