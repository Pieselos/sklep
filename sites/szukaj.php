<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/style/main.css">

</head>
<body>
    <a href="koszyk.php">koszyk</a>
    <a href="ustawieniaKonta.php">Ustawienia konta</a>
    <a href='szukaj.php'>Szukaj</a>
    <?php
        session_start();
        if(empty($_SESSION['user'])){
            echo "<a href='login.php'>Login</a>";
        }else{
            echo "<a href='logout.php'>logout</a>";
        }

    ?>
    <form>
        <?php
            
            include('../script/selectKategorie.php');
            include('../script/selectProducent.php');
        ?>
        <input type="number" name="pmin">
        <input type="number" name="pmax">
        <label><input type="checkbox" name="ava">Dostępny?</label>
        <input type="submit">
    </form>
    <?php






        
        require("../script/wyswietlproduktyfiltry.php")

    ?>


    





    <script src="../bootstrap/js/bootstrap.js"></script>  
</body>
</html>