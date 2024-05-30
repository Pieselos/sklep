<?php

session_start();
if(empty($_SESSION['user'])){
    header('Location: http://localhost/sites/index.php');
    exit;
}else{
    
    $connect=mysqli_connect("localhost","root","","sklep");
    $produkt_id = $_POST['id'];
    $user = $_SESSION['user'];
    $query = "SELECT user_id FROM user WHERE login = '$user'";
    $userId = $connect->query($query);
    $userId = $userId->fetch_object()->user_id;
    $query = "SELECT koszyk_id FROM koszyk WHERE user_id = $userId";
    $koszyk_id = $connect->query($query);
    if(mysqli_num_rows($koszyk_id) == 0){
        $query = "INSERT INTO koszyk (user_id) VALUES ($userId)";
        $connect->query($query);
        $query = "SELECT koszyk_id FROM koszyk WHERE user_id = $userId";
        $koszyk_id = $connect->query($query);
    }
    $koszyk_id = $koszyk_id->fetch_object()->koszyk_id;
    $query = "SELECT produktKoszyk_id FROM produktkoszyk WHERE koszyk_id = $koszyk_id AND produkt_id = $produkt_id";
    $result = $connect->query($query);
    if(mysqli_num_rows($result)){
        $result = $result->fetch_object();
        $produktKoszyk_id = $result->produktKoszyk_id;
        $query = "UPDATE produktkoszyk SET ilosc_koszyk = ilosc_koszyk + 1 WHERE produktKoszyk_id = $produktKoszyk_id";
        $connect->query($query);
        header("Location: http://localhost/sites/koszyk.php");
        exit;
    }else {
        $query = "INSERT INTO produktkoszyk (koszyk_id, produkt_id, ilosc_koszyk) VALUES ($koszyk_id, $produkt_id, 1)";
        $connect->query($query);
        header("Location: http://localhost/sites/koszyk.php");
        exit;
    }
}



