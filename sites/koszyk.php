<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            height: 50px;
            width: 50px;
        }
    </style>
</head>
<body>
    <?php
    
    require("../script/wyswietlkoszyk.php");
    require("../script/koszykSprawdzianieIlosci.php");
    $cenaCalosc = 0;
    if($flagaPusty){
        echo "Koszyk jest pusty";
    }else{
        echo<<<et
            <table>
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
            $cenaCalosc = $cenaCalosc + $cena;
            echo<<<et

                <tr>
                    <td><img src="$zdjecie"></td>
                    <td>$nazwa</td>
                    <td>$ilosc</td>
                    <td>$cena zł</td>
                    <td>
                        <form action="../script/manipulacjeKoszykiem.php" method="post">
                            <input type="hidden" name="produktKoszykId" value="$idProduktKoszk">
                            <input type="submit" name="kontrola" value="+">
                            <input type="submit" name="kontrola" value="-">
                            <input type="submit" name="kontrola" value="usun">
                        </form>
                    </td>
                </tr>

            et;
        }
        echo "<td></td> <td></td> <td></td> <td>$cenaCalosc zł</td> <td></td> ";
        echo "</table>";
        echo "<a href='zamowienie.php'><button>Zamów</button></a>";
    }
    
    ?>


   
</body>
</html>