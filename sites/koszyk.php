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
    <a href="koszyk.php">koszyk</a>
    <a href="ustawieniaKonta.php">Ustawienia konta</a>
    <a href='szukaj.php'>Szukaj</a>
    <a href="index.php">Index</a>
    <?php
        if(empty($_SESSION['user'])){
            echo "<a href='login.php'>Login</a>";
        }else{
            echo "<a href='logout.php'>logout</a>";
        }

    ?>
    <br>
    <?php
    
    require("../script/wyswietlkoszyk.php");
    require("../script/koszykSprawdzianieIlosci.php");
    $cenaCalosc = 0;
    if($flagaPusty){
        echo "Koszyk jest pusty";
        exit;
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
            $idProdukt = $idProduktArray[$i];
            $nazwa = $nazwaArray[$i];
            $cenaCalosc = $cenaCalosc + $cena;
            $idProduktKoszyk = $produktKoszykIdArray[$i];
            echo<<<et

                <tr>
                    <td><img src="$zdjecie"></td>
                    <td><a href="http://localhost/sites/produkt.php?id=$idProdukt">$nazwa</a></td>
                    <td>$ilosc</td>
                    <td>$cena zł</td>
                    <td>
                        <form action="../script/manipulacjeKoszykiem.php" method="post">
                            <input type="hidden" name="produktKoszykId" value="$idProduktKoszyk">
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

        
    }
    
    ?>
    <form method="POST" action="zamowienie.php">
        <table>
            <tr>
                <td><label><input type="radio" name="przesylka" value="inpost" required> Inpost (10 zł)</label></td>
            </tr> 
            <tr>
                <td><label><input type="radio" name="przesylka" value="dhl"  required> DHL (13 zł)</label><br></td>
            </tr>   
            <tr>
                <td><label><input type="radio" name="przesylka" value="dpd"required> DPD (15 zł)</label><br></td>
            </tr>
            <td><input type="submit" value="Zamów"></td>
        </table>
    </form>

   
</body>
</html>