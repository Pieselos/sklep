<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $kategoriaId = $_POST['kategoria_id'];
        $connect=mysqli_connect("localhost","root","","sklep");
        $query = "SELECT * FROM kategoria WHERE kategoria_id = $kategoriaId";
        $nazwa_kategorii = $connect->query($query)->fetch_object()->nazwa_kategoria;
        echo<<<et
            <form method='post' action='adminKategorie.php?mode=kategorie'>
                <input type='hidden' name='kategoria_id' value='$kategoriaId'>
                
                <input name='nazwa_kategorii' value='$nazwa_kategorii'>
                <input type='submit' name='submode' value='modyfikuj'>
            </form>
        et;


    ?>
</body>
</html>