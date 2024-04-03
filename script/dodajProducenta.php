<?php

if(isset($_POST["nazwa_producent"])){
    $connect=mysqli_connect("localhost","root","","sklep");
    $nazwa = $_POST['nazwa_producent'];
    $query = "INSERT INTO producent (nazwa) VALUES ('$nazwa')";
    $connect->query($query);
    $error = $connect->error;
    if($error){
        echo "Błąd: $error";
    }else{
        echo "Dodano producenta o nazwie: $nazwa";
    }
}

