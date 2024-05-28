<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../script/previewImage.js"></script>
    <!-- <script src="../script/previewImages.js"></script> -->
</head>
<body>
    <a href="admin.php">admin.php</a>
    <?php
        session_start();
        if (empty($_SESSION['admin'])){
            header('Location: http://localhost/sites/admin.php');
            exit;
        }
    ?>
    <p>DODAJ PRODUKT</p>
    <form method="POST" enctype="multipart/form-data" action="/script/dodajProdukt.php" target="dodajProduktRes">
        <table>
            <tr>
                <td>Nazwa</td>
                <td><input name="produktNazwa" required> </td>
            <tr>
            <tr>
                <td>Kategoria</td>
                <td>
                    <?php
                        $DR = $_SERVER['DOCUMENT_ROOT'];
                        require("$DR/script/selectKategorie.php");
                    ?>
                </td>
            </tr>
            <tr>
                <td>Producent</td>
                <td>
                    <?php
                        $DR = $_SERVER['DOCUMENT_ROOT'];
                        require("$DR/script/selectProducent.php");
                    ?>
                </td>
            </tr>
            <tr>
                <td>Ilosc magazyn</td>
                <td>
                    <input name="iloscMagazyn" type="number" required>
                </td>
            </tr>
            <tr>
                <td>Cena_brutto</td>
                <td>
                    <input name="cenaBrutto" type="number" step="0.01" required>
                </td>
            </tr>
            <tr>
                <td>opis</td>
                <td>
                    <textarea name='opis' rows="4" cols="45" required></textarea>
                </td>
            </tr>
            <tr>
                <td>zdjęcie główne</td>
                <td>
                    <input name="zdjGlowne" type="file" required onchange="previewImage(this) ">
                    <div id="zdjGlowne"></div>
                </td>
            </tr>
            <tr>
                <td>zdjęcia</td>
                <td>
                <input name="zdjecia[]" type="file" onchange="previewImages(this)" multiple>
                <div id="zdjecia"></div>
                </td>
            </tr>        
            <tr>
                <td><input type="submit"></td>
            </tr>    
        <table>
        


    </form>
    <iframe name="dodajProduktRes" height="40px"></iframe>

    



    <hr>
    <p>DODAJ KATEGORIE</p>
    <form method="POST" action="/script/dodajKategorie.php" target="wynikKategoria">
        
        Nazwa kategorii <input name="nazwa_kategoria" minlength="4" required><br>
        <input type="submit" >
    </form><br>
    <iframe name="wynikKategoria" height="40px"></iframe>
    

    

    <hr>
    <p>DODAJ PRODUCENTA</p>
    
    <form method="POST" action="/script/dodajProducenta.php" target="wynikProducent">
        
        Nazwa producenta <input name="nazwa_producent" minlength="4" required><br>
        <input type="submit">
    </form><br>
    <iframe name="wynikProducent" height="40px"></iframe>
</body>
</html>