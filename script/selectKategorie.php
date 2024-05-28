<?php

    $connect=mysqli_connect("localhost","root","","sklep");
    $kategorie = $connect->query("SELECT * from kategoria");
    

    echo "<select name='produktKategoria'>";
    while($kategoria = $kategorie->fetch_object()){
        echo "<option value='$kategoria->kategoria_id'>$kategoria->nazwa_kategoria</option>";
    }
    echo "</select>";
