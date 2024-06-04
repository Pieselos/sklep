<?php
    session_start();
    if (empty($_SESSION['user'])){
        header("Location: http://localhost/sites/login.php");
        exit;
    }else{
        $connect=mysqli_connect("localhost","root","","sklep");
        
        $kod = $_POST['kodPocztowy'];
        $adres = $_POST['adres'];
        $miasto = $_POST['miasto'];
        $user =  $_SESSION['user'];
        $query = "SELECT adres_id FROM user WHERE login = '$user'";
        $result = $connect->query($query)->fetch_object();
        if($result->adres_id == NULL){
            $query = "INSERT INTO adres (kod_pocztowy, adres, miasto) VALUES ('$kod','$adres','$miasto')";
            $connect->query($query);
            if($connect->errno == 0){
                $adres_id = mysqli_insert_id($connect);
                $query = "UPDATE user SET adres_id = $adres_id WHERE login = '$user'";
                $connect->query($query);
                header("Location: http://localhost/sites/ustawieniaKonta.php");
                exit;
            }
        }else {
            $adres_id = $result->adres_id;
            $query = "UPDATE adres SET kod_pocztowy = '$kod', adres = '$adres', miasto = '$miasto' WHERE adres_id = $adres_id";
            $connect->query($query);
        
        }
    }

    // Dodać zmienianie adresu