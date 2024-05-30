<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        img{
            height: 150px;

        }
    </style>
</head>
<body>
    <?php
        session_start();
        $connect=mysqli_connect("localhost","root","","sklep");
        $produkt_id = $_GET['id'];
        $query = "SELECT produkt.nazwa AS produktNazwa, producent.nazwa AS producentNazwa, zdj_glowne, ilosc_magazyn, cena_brutto, opis, nazwa_kategoria FROM produkt JOIN kategoria USING(kategoria_id) JOIN producent USING(producent_id) WHERE produkt_id = $produkt_id";
        $info = $connect->query($query);
        $info = $info->fetch_object();

        $query = "SELECT nazwaPliku FROM zdjecia WHERE produkt_id = $produkt_id";
        $zdjecia = $connect->query($query);
        echo "<div>";

        echo "<img src='http://localhost/img/$info->zdj_glowne' alt='zdjecie produktu'>";
        
        while($row = $zdjecia->fetch_object()){
            echo "<img src='http://localhost/img/$row->nazwaPliku' alt='zdjecie produktu'>";
        }
        echo "</div>";
        echo<<<et
            Nazwa: $info->produktNazwa <br>
            Producent: $info->producentNazwa <br>
            Kategoria: $info->nazwa_kategoria <br>
            
            Ilość: $info->ilosc_magazyn <br>
            Cena: $info->cena_brutto <br>
            opis: $info->opis <br>
        et;

        if(empty($_SESSION['user'])){
            echo<<<et
                
            <form action="login.php">
                <input type="submit" value="Dodaj do koszyka">
            </form>
            et;
        }else{
            echo<<<et
                <form action="../script/dodajDoKoszyka.php" method='post'>
                    <input type="hidden" name='id' value="$produkt_id">
                    <input type="submit" value="Dodaj do koszyka">
                </form>
            et;
        }

        echo "</div>";
                
    ?>

        

</body>
</html>