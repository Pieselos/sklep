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
        session_start();
        if(empty($_SESSION['user'])){
            header('Location: http://localhost/sites/login.php');
            exit;
        }
        $sesjaUser = $_SESSION['user'];
        @require("../script/wyswietlkoszyk.php");
        require("../script/koszykSprawdzianieIlosci.php");
        $cenaCalosc = 0;
        if($flagaPusty){
            echo "Nie ma nic do zamówienia";
        }else{
            echo<<<et
                <table>
                    <tr>
                        <th></th>
                        <th>Produkt</th>
                        <th>Ilość</th>
                        <th>Cena</th>
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
                    </tr>

                et;
            }
            echo "<td></td> <td></td> <td></td> <td>$cenaCalosc zł</td>";
            echo "</table>";
            
        }
        
        $query = "SELECT adres, kod_pocztowy, miasto, telefon FROM user JOIN adres USING(adres_id) WHERE login = '$sesjaUser'";
        $result = $connect->query($query)->fetch_object();
        $adresBaza = $result->adres;
        $kodBaza = $result->kod_pocztowy;
        $miastoBaza = $result->miasto;
        $telefonBaza = $result->telefon;

    ?>

    <form method="post" action="../script/zmienAdres.php">
        
        <label><input name="adres" maxlength="30" value="<?=$adresBaza?>" require> Adres</label><br>
        <label><input name="kodPocztowy" pattern="[0-9]{2}-[0-9]{3}" value="<?=$kodBaza?>" require> Kod pocztowy</label><br>
        <label><input name="miasto" maxlength="30" value="<?=$miastoBaza?>" require> Miasto</label><br>
        
        <div>
            Płatność:<br>
            <label><input type="radio" name="platnosc" value="blik"> Blik</label><br>
            <label><input type="radio" name="platnosc" value="karta"> Karta</label><br>
            <label><input type="radio" name="platnosc" value="gotuwa"> Gotówka</label><br>
        </div>

        <div>
            Przesyłka:<br>
            <label><input type="radio" name="przesylka" value="paczkomat"> Paczkomat</label><br>
            <label><input type="radio" name="przesylka" value="dhl"> DHL</label><br>
            <label><input type="radio" name="przesylka" value="dpd"> DPD</label><br>
        </div>
            
        <div>
            <input type="submit" value="Zamów">
        </div>
    </form>

</body>
</html>