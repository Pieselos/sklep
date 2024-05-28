<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td,tr,th{
            border: black 1px solid;
        }
        table{
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    
    <?php

        session_start();

        if (empty($_SESSION['admin'])){
           echo<<<et
                <form action="../script/loginAdmin.php" method="POST">
                    <input name="login" type="text">
                    <input name="password" type="password">
                    <input type="submit">
                </form>
           et;
        }else{
            
            echo<<<et
                <div>
                    Edycja i wyswietlanie<br>
                    <a href="./admin.php?mode=produkty">Produkty</a>
                    <a href="./admin.php?mode=kategorie">Kategorie</a>
                    <a href="./admin.php?mode=producenci">Producenci</a>
                    <a href="./admin.php?mode=zamowienia">Zamowienia</a>
                    <a href="./admin.php?mode=uzytkownicy">użytkownicy</a><br>
                    Dodawanie<br>
                    <a href="./prodAdd.php">Dodawanie</a>
                </div>
            et;
            if(ISSET($_GET['mode'])){
                switch ($_GET['mode']) {
                    case 'produkty':
                        require('../script/admin/adminProdukt.php');
                        break;
                    case 'kategorie':
                        require('../script/admin/adminKategorie.php');
                        break;
                    case 'producenci':
                        require('../script/admin/adminProducenci.php');
                        break;
                    case 'zamowienia':
                        require('../script/admin/adminZamowienia.php');
                        break;
                    case 'uzytkownicy':
                        require('../script/admin/adminUzytkownicy.php');
                        break;
                    default:
                        # code...
                        break;
                }
                
            }

        }


    ?>
    
    


</body>
</html>