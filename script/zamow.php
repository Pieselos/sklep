<?php
    session_start();
    if(empty($_SESSION['user'])){
        header("Location: http://localhost/sites/login.php");
        exit;
    } else {
        $connect=mysqli_connect("localhost","root","","sklep");
        $przesylka = $_POST['przesylka'];
        $platnosc = $_POST['platnosc'];
        $adres = $_POST['adres'];
        $kodPocztowy = $_POST['kodPocztowy'];
        $miasto = $_POST['miasto'];
        $imie = $_POST['Imie'];
        $nazwisko = $_POST['Nazwisko'];
        $telefon = $_POST['telefon'];
        $user = $_SESSION['user'];

    

        $query = "SELECT user_id FROM user WHERE login = '$user'";
        $userId = $connect->query($query)->fetch_object()->user_id;
        
        $query = "SELECT koszyk_id FROM koszyk WHERE user_id = $userId";
        $koszyk_id = $connect->query($query)->fetch_object()->koszyk_id;

        $query = "INSERT INTO zamowienie (user_id, platnosc, przesylka, status, Imie, Nazwisko, kod_pocztowy, Miasto, adres, telefon_zamowienie) VALUES ($userId, '$platnosc', '$przesylka', 'przygotowanie', '$imie', '$nazwisko', '$kodPocztowy', '$miasto', '$adres', '$telefon')";
        $connect->query($query);
        $zamowienie_id = $connect->query("SELECT LAST_INSERT_ID() as insert_id")->fetch_object()->insert_id;

        $query = "INSERT INTO produktZamowienie SELECT NULL, produkt_id, ilosc_koszyk as ilosc_zamowienie, $zamowienie_id as zamowienie_id FROM produktKoszyk WHERE koszyk_id=$koszyk_id;";
        $connect->query($query);
        
        $query = "SELECT produkt_id, ilosc_koszyk FROM produktKoszyk WHERE koszyk_id = $koszyk_id";
        $result = $connect->query($query);
        
        while($row = $result->fetch_object()){
            $query = "UPDATE produkt SET ilosc_magazyn = ilosc_magazyn - $row->ilosc_koszyk WHERE produkt_id = $row->produkt_id";
            $connect->query($query);
        }
        $query = "DELETE FROM produktKoszyk WHERE koszyk_id = $koszyk_id";
        $connect->query($query);

        if($connect->error){
            echo "Błąd";
            exit;
        }
        
        
        
        
        
        echo '<pre>';
        print_r($_POST);
        echo '</pre>';

        if($connect->error){
            echo "Błąd";
            exit;
        }

        header("Location: http://localhost/sites/zakonczenieZamowienia.php");
        exit;
        


    }
