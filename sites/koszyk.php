<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    require("../script/wyswietlkoszyk.php");
    if($flagaPusty){
        echo "Koszyk jest pusty";
    }else{
        echo<<<et

            <tr>
                <th></th>
                <th>Produkt</th>
                <th>Ilość</th>
                <th>Cena</th>
                <th></th>
            </tr>

        et;
    
        for($i = 0; $i < count($nazwaArray); $i++){
            $zdjecie = $zdjeciaArray[$i];
            $ilosc = $iloscArray[$i];
            $cena = $ilosc*$cenaArray[$i];
            $idProduktKoszk = $idProduktKoszykArray[$i];
            $nazwa = $nazwaArray[$i];
            echo<<<et

                <tr>
                    <td><img src="$zdjecie"></td>
                    <td>$nazwa</td>
                    <td>$ilosc</td>
                    <td>$cena</td>
                    <td>
                        <form action="../script/manipulacjeKoszykiem.php">
                            <input type="hidden" name="produktKoszykId" value="$idProduktKoszk">
                            <input type="submit" name="kontrola" value="+">
                            <input type="submit" name="kontrola" value="-">
                            <input type="submit" name="kontrola" value="usun">
                        </form>
                    </td>
                </tr>

            et;
        }
        echo "</table>";
    }
    
    ?>


   
</body>
</html>