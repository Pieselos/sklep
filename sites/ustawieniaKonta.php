<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="koszyk.php">koszyk</a>
    <a href="ustawieniaKonta.php">Ustawienia konta</a>
    <a href='szukaj.php'>Szukaj</a>
    <a href='index.php'>Index</a>
    <?php
        session_start();
        if(empty($_SESSION['user'])){
            echo "<a href='login.php'>Login</a>";
        }else{
            echo "<a href='logout.php'>logout</a>";
        }

    ?><br>
    <?php
        $connect=mysqli_connect("localhost","root","","sklep");
        
        require("../script/root.php");
        
        

        if (empty($_SESSION['user'])){
            header("Location: http://localhost/sites/login.php");
            exit;
        } else {
            
            $sesjaUser = $_SESSION['user'];
            echo <<<et
                Witaj $sesjaUser
            et;
        }


        $query = "SELECT adres, kod_pocztowy, miasto, telefon FROM user LEFT JOIN adres USING(adres_id) WHERE login = '$sesjaUser'";
        $result = $connect->query($query)->fetch_object();
        @$adresBaza = $result->adres;
        @$kodBaza = $result->kod_pocztowy;
        @$miastoBaza = $result->miasto;
        @$telefonBaza = $result->telefon;
        
    ?>
    
        <ul>
            <li>
                <ul>
                    <form method="post" action="../script/zmienAdres.php">
                        <li>Adres</li>
                        <li><label><input name="adres" maxlength="30" value="<?=$adresBaza?>" require> Adres</label></li>
                        <li><label><input name="kodPocztowy" pattern="[0-9]{2}-[0-9]{3}" value="<?=$kodBaza?>" require> Kod pocztowy</label></li>
                        <li><label><input name="miasto" maxlength="30" value="<?=$miastoBaza?>" require> Miasto</label></li>
                        <input type="submit" value="Zmień adres">
                    </form>
                </ul>
            </li>
            <li>
                <form method="post" action="../script/zmienTelefon.php">
                    <input name="telefon" pattern="(\+48)?[0-9]{9}" value='<?=$telefonBaza?>'><input type="submit" value="Zmien telefon">
                </form>
            </li>
        </ul>
    
</body>
</html>