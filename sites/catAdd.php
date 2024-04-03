<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        Nazwa kategorii <input name="nazwa_kategoria" minlength="4" required><br>
        <input type="submit" >
    </form>
    <a href="prodAdd.php">Dodaj Produkt</a>
    
    <?php
        $DR = $_SERVER['DOCUMENT_ROOT'];
        require($DR."/script/dodajKategorie.php");
        // if(isset($_POST["nazwa_kategoria"])){
        //     $connect=mysqli_connect("localhost","root","","sklep");
        //     $nazwa = $_POST['nazwa_kategoria'];
        //     $query = "INSERT INTO kategoria (nazwa) VALUES ('$nazwa')";
        //     $connect->query($query);
        //     $error = $connect->error;
        //     if($error){
        //         echo "Błąd: $error";
        //     }else{
        //         echo "Dodano kategorie o nazwie: $nazwa";
        //     }
        // }



    ?>
</body>
</html>