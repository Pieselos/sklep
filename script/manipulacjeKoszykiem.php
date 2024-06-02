<?php
session_start();

if(empty($_SESSION['user'])){
    header("Location: http://localhost/sites/login.php");
    exit;
}else{
    
    
    $produktKoszyk_id = $_POST['produktKoszykId'];
    $kontrola = $_POST['kontrola'];
    $connect=mysqli_connect("localhost","root","","sklep");


    

    if($kontrola == 'usun'){
       
        $query = "DELETE FROM produktkoszyk WHERE produktKoszyk_id = $produktKoszyk_id";
        $connect->query($query);
        header("Location: http://localhost/sites/koszyk.php");
        exit;
    }
    if($kontrola == '+'){
        $query = "UPDATE produktkoszyk SET ilosc_koszyk = ilosc_koszyk + 1 WHERE produktKoszyk_id = $produktKoszyk_id";
        $connect->query($query);
        $query = "SELECT koszyk_id FROM produktkoszyk WHERE produktkoszyk_id = $produktKoszyk_id";
        $koszykId = $connect->query($query)->fetch_object()->koszyk_id;
        require('../script/koszykSprawdzianieIlosci.php');
    }
    if($kontrola == '-'){
        $query = "UPDATE produktkoszyk SET ilosc_koszyk = ilosc_koszyk - 1 WHERE produktKoszyk_id = $produktKoszyk_id";
        $connect->query($query);
        $query = "SELECT ilosc_koszyk FROM produktkoszyk WHERE produktkoszyk_id = $produktKoszyk_id";
        $result = $connect->query($query)->fetch_object();
        if($result->ilosc_koszyk == 0){
            $query = "DELETE FROM produktkoszyk WHERE produktKoszyk_id = $produktKoszyk_id";
            $connect->query($query);
        }
        
    }
    
    
    
    header("Location: http://localhost/sites/koszyk.php");
    exit;
}
