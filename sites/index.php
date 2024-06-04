<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/style/main.css">

    
</head>
<body >
    <?php 
        require('../script/root.php');
        session_start();
        
    ?>
    <a href="koszyk.php">koszyk</a>
    <a href="ustawieniaKonta.php">Ustawienia konta</a>
    <a href='szukaj.php'>Szukaj</a>
    <?php
        if(empty($_SESSION['user'])){
            echo "<a href='login.php'>Login</a>";
        }else{
            echo "<a href='logout.php'>logout</a>";
        }

    ?>
    <!-- <div class="container">
        <div> 
           
            <li class="card bg-dark" style="width: 18rem;">
                <a class="aFordiv" href="adsd.html">
                    <img src="/img/wedka1.jpg" class="card-img-top" alt="wedka">
                    <div class="card-body">
                        <h5 class="card-title">Wędka Schimano</h5>
                        <p class="card-text">Wędki </p>
                        <p class="card-text">cena</p>
                    </div>
                </a>
            </li>
            
        </div>
    </div> -->
    <div class="container" style="display: flex;">
    <?php
        require("../script/wyswietlWszystkoKarty.php")

    ?>
    </div>
    <script src="../bootstrap/js/bootstrap.js"></script>

</body>
</html>