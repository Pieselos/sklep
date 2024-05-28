<?php

if(isset($_POST["nazwa_kategoria"])){
    $connect=mysqli_connect("localhost","root","","sklep");
    $nazwa = $_POST['nazwa_kategoria'];
    $query = "INSERT INTO kategoria (nazwa_kategoria) VALUES ('$nazwa')";
    $connect->query($query);
    $error = $connect->error;
    if($error){
        echo "Błąd: $error";
    }else{
        echo "Dodano kategorie o nazwie: $nazwa";
    }
}


