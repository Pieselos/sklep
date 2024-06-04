<?php

session_start();



if (empty($_SESSION['user'])){
    header("Location: http://localhost/sites/login.php");
    exit;
}else{
    $connect=mysqli_connect("localhost","root","","sklep");
    
    $user = $_SESSION['user'];
    $query = "SELECT koszyk_id, user_id FROM user JOIN koszyk USING(user_id) WHERE login = '$user'";
    $result = $connect->query($query);
    if(mysqli_num_rows($result) == 0){
        $query = "SELECT user_id FROM user WHERE login = '$user'";
        $result = $connect->query($query);
        $result = $result->fetch_object();
        $query = "INSERT INTO koszyk (user_id) VALUES ($result->user_id)";
        $connect->query($query);
        $koszykId = $connect->insert_id;

    } else {
        $result = $result->fetch_object();
        $koszykId = $result->koszyk_id;
    }
    
    $query = "SELECT nazwa, cena_brutto, ilosc_koszyk, zdj_glowne, produkt_id, produktKoszyk_Id FROM produktkoszyk JOIN produkt USING(produkt_id) WHERE koszyk_id = $koszykId";
    $result = $connect->query($query);
    if(mysqli_num_rows($result)){
        $flagaPusty = 0;
        $nazwaArray = array();
        $iloscArray = array();
        $cenaArray = array();
        $zdjeciaArray = array();
        $idProduktArray = array();
        $produktKoszykIdArray = array();
        while($row = $result->fetch_object()){
            $nazwaArray[] = $row->nazwa;
            $iloscArray[] = $row->ilosc_koszyk;
            $cenaArray[] = $row->cena_brutto;
            $zdjeciaArray[] = "http://localhost/img/".$row->zdj_glowne;
            $idProduktArray[] = $row->produkt_id;
            $produktKoszykIdArray[] = $row->produktKoszyk_Id;
        }
    }else {
        $flagaPusty = 1;
    }
    

}

