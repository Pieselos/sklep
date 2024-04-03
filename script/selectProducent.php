<?php

    $connect=mysqli_connect("localhost","root","","sklep");
    $producenci = $connect->query("SELECT * from producent");
    

    echo "<select name='produktProducent'>";
    while($producent = $producenci->fetch_object()){
        echo "<option value='$producent->producent_id'>$producent->nazwa</option>";
    }
    echo "</select>";
