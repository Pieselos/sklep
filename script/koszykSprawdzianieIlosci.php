<?php

//Sprawdzanie czy w koszyku nie ma wiecej produktu niz na stanie

$query = "UPDATE produktkoszyk pk JOIN produkt p USING(produkt_id) SET pk.ilosc_koszyk = p.ilosc_magazyn WHERE pk.ilosc_koszyk > p.ilosc_magazyn AND koszyk_id = $koszykId";
$connect->query($query);


// 