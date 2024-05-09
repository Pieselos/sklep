<?php

$connect=mysqli_connect("localhost","root","","sklep");

$produktId = $_GET['id'];


//Wyciąganie wszytkich informacji o produkcie
$query = "SELECT * FROM produkt JOIN kategoria USING('kategoria_id') JOIN producent USING('producent_id') WHERE produkt_id = $produktId";
$infoProdukt = $connect->query($query);
$infoProdukt = $infoProdukt->fetch_object();

$produktNazwa = $infoProdukt->nazwa;
$produktKategoria = $infoProdukt->nazwa_kategoria;
$produktOpis = $infoProdukt->opis;
$produktIlosc = $infoProdukt->ilosc_magazyn;
$prodktCenaBrutto = $infoProdukt->cena_brutto;
$produktZdjecieGlowne = $infoProdukt->zdj_glowne;

//Wyciąganie ścierzek zdjec z bazy

$produktZdjeciaPoboczne = array();
$query = "SELECT * FROM zdjecia WHERE produkt_id = $produktId";
$zdjecia = $connect->query($query);
while($zdj = $zdjecia->fetch_object()){
    $produktZdjeciaPoboczne[] = $zdj->nazwaPliku;
}

//Wyciąganie opinii
$opinieTresc = array();
$opinieLoginy = array();
$opinieOceny = array();
$query = "SELECT login, trescOpinia, Ocena FROM opinia JOIN user USING('user_id') WHERE produkt_id = $produktId ";
$opinie = $connect->query($query);
while($opi = $opinie->fetch_object()){
    $opinieTresc[] = $opi->trescOpinial;
    $opinieLoginy[]= $opi->login;
    $opinieOceny[] = $opi->ocena;
}