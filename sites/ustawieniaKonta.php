<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $connect=mysqli_connect("localhost","root","","sklep");
        
        require("../script/root.php");
        session_start();
        

        if (empty($_SESSION['user'])){
            header("Location: http://localhost/sites/login.php");
            exit;
        } else {
            
            $sesjaUser = $_SESSION['user'];
            echo <<<et

                Witaj $sesjaUser
            et;
        }


        $query = "SELECT adres, kod_pocztowy, miasto, telefon FROM user JOIN adres USING(adres_id) WHERE login = '$sesjaUser'";
        $result = $connect->query($query)->fetch_object();
        $adresBaza = $result->adres;
        $kodBaza = $result->kod_pocztowy;
        $miastoBaza = $result->miasto;
        $telefonBaza = $result->telefon;
        
    ?>
    
        <ul>
            
            <ul>
                <form method="post" action="../script/zmienAdres.php">
                    <li>Adres</li>
                    <li><label><input name="adres" maxlength="30" value="<?=$adresBaza?>" require> Adres</label></li>
                    <li><label><input name="kodPocztowy" pattern="[0-9]{2}-[0-9]{3}" value="<?=$kodBaza?>" require> Kod pocztowy</label></li>
                    <li><label><input name="miasto" maxlength="30" value="<?=$miastoBaza?>" require> Miasto</label></li>
                    <input type="hidden" name="user" value="<?=$sesjaUser?>">
                    <input type="submit">
                </form>
            </ul>
        </ul>
    
</body>
</html>