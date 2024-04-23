<?php




$connect=mysqli_connect("localhost","root","","sklep");
$query = "SELECT * FROM produkt WHERE ";


if(isset($_GET["katID"])){
    $szukanaKategoriaID = $_GET["katID"];
    $query = $query."kategoria_id=$szukanaKategoriaID AND ";
}

if(isset($_GET["prodID"])){
    $producentID = $_GET["prodID"];
    $query = $query."producent=$producentID AND ";
}

if(isset($_GET["pmin"])){
    $cenaMinimalna = $_GET["pmin"];
    $query = $query."cenaMinimalna >= $cenaMinimalna AND ";

}
if(isset($_GET["pmax"])){
    $cenaMaksymalna = $_GET["pmax"];
    $query = $query."cenaMinimalna <= $cenaMaksymalna AND ";

}
if(isset($_GET["ava"])){
    $query = $query."ilosc_magazyn > 0";
}

if(str_ends_with($query,"AND ")){
    substr($query,0,-4);
}



if(str_ends_with($query,"WHERE ")){
    $query = substr($query,0,-6);
}



echo $query;



$connect->close();
