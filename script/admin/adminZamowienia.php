<?php
    if(empty($_SESSION['admin'])){
        header("Location: http://localhost/sites/admin.php");
        exit;
    }else{
        $connect=mysqli_connect("localhost","root","","sklep");
        
        
        
        
        if(isset($_POST['submode'])){
            if($_POST['submode'] == 'usun'){
                $zamowienie_id = $_POST['zamowienie_id'];
                
                $query = "DELETE FROM zamowienie WHERE zamowienie_id = $zamowienie_id";
                
                $connect->query($query);
            }
            if($_POST['submode'] == 'modyfikuj'){
                $zamowienieId = $_POST['zamowienie_id'];
                $connect=mysqli_connect("localhost","root","","sklep");
                $query = "SELECT * FROM zamowienie LEFT JOIN user USING(user_id) WHERE zamowienie_id = $zamowienieId";
                $result = $connect->query($query)->fetch_object();
                $zamowienie_id = $result->zamowienie_id;
                $user_id = $result->user_id;
                $login = $result->login;
                $email = $result->email;
                $data = $result->data;
                $platnosc = $result->platnosc;
                $przesylka = $result->przesylka;
                $status = $result->status;
                $imie = $result->Imie;
                $nazwisko = $result->Nazwisko;
                $kod_pocztowy = $result->kod_pocztowy;
                $miasto = $result->miasto;
                $adres = $result->adres;
                $telefon_zamowienie = $result->telefon_zamowienie;
                
                echo <<<et
                    <table>
                    <tr>
                        <th>Parametr</th>
                        <th>wartosc</th>
                    </tr>
                    <tr>
                        <td>zamowienie_id</td>
                        <td>$zamowienie_id</td>
                    </tr>
                    <tr>
                        <td>user_id</td>
                        <td>$user_id</td>
                    </tr>
                    <tr>
                        <td>login</td>
                        <td>$login</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td>$email</td>
                    </tr>
                    <tr>
                        <td>data</td>
                        <td>$data</td>
                    </tr>
                    <tr>
                        <td>platnosc</td>
                        <td>$platnosc</td>
                    </tr>
                    <tr>
                        <td>przesylka</td>
                        <td>$przesylka</td>
                    </tr>
                    <tr>
                        <td>status</td>
                        <td>$status</td>
                    </tr>
                    <tr>
                        <td>imie</td>
                        <td>$imie</td>
                    </tr>
                    <tr>
                        <td>nazwisko</td>
                        <td>$nazwisko</td>
                    </tr>
                    <tr>
                        <td>kod_pocztowy</td>
                        <td>$kod_pocztowy</td>
                    </tr>
                    <tr>
                        <td>miasto</td>
                        <td>$miasto</td>
                    </tr>
                    <tr>
                        <td>adres</td>
                        <td>$adres</td>
                    </tr>
                    <tr>
                        <td>telefon_zamowienie</td>
                        <td>$telefon_zamowienie</td>
                    </tr>
                    </table>
                et;

                $query = "SELECT produkt_id, nazwa, cena_brutto, ilosc_zamowienie, zdj_glowne FROM produktzamowienie JOIN produkt USING(produkt_id) WHERE zamowienie_id = $zamowienie_id";
                
                $cenaCalosc = 0;
                $result = $connect->query($query);
                if(mysqli_num_rows($result)){
                    $flagaPusty = 0;
                    $nazwaArray = array();
                    $iloscArray = array();
                    $cenaArray = array();
                    $zdjeciaArray = array();
                    $produkt_id = array();
                    while($row = $result->fetch_object()){
                        $nazwaArray[] = $row->nazwa;
                        $iloscArray[] = $row->ilosc_zamowienie;
                        $cenaArray[] = $row->cena_brutto;
                        $zdjeciaArray[] = "http://localhost/img/".$row->zdj_glowne;
                        $produkt_idArray[] = $row->produkt_id;
                    }
                    echo "<table>";
                    for($i = 0; $i < count($nazwaArray); $i++){
                        $zdjecie = $zdjeciaArray[$i];
                        $ilosc = $iloscArray[$i];
                        $cena = $ilosc*$cenaArray[$i];
                        $nazwa = $nazwaArray[$i];
                        $produkt_id = $produkt_idArray[$i];
                        $cenaCalosc = $cenaCalosc + $cena;
                        echo<<<et
            
                            <tr>
                                <td><img src="$zdjecie"></td>
                                <td><a href="http://localhost/sites/produkt.php?id=$produkt_id">$nazwa</a></td>
                                <td>$ilosc</td>
                                <td>$cena zł</td>
                            </tr>
            
                        et;
                       
                        
                    }
                    switch ($przesylka) {
                        case 'inpost':
                            $cenaDostawa = 10;
                            break;
                        
                        case 'dhl':
                            $cenaDostawa = 13;
                            break;
                        case 'dpd':
                            $cenaDostawa = 15;
                            break;
                        default:
                            $cenaDostawa = 0;
                            break;
                    }
                    echo "<tr><td>Dostawa</td> <td>$przesylka</td> <td>1</td> <td>$cenaDostawa zł</td></tr>";
                    $cenaCalosc = $cenaCalosc + $cenaDostawa;


                    echo "<tr><td></td> <td></td> <td>Suma:</td> <td>$cenaCalosc zł</td></tr></table>";
                    echo<<<et
                        <div>
                            <h1>Zmień status</h1>
                            <form method='post'>
                                <input type='hidden' name='zamowienie_id' value='$zamowienieId'>
                                <select name='status'>
                    et;
                        switch ($status) {
                            case 'przygotowanie':
                                echo<<<et
                                    <option value='przygotowanie' selected>przygotowanie</option>
                                    <option value='wyslana' >wyslana</option>
                                    <option value='dostarczona' >dostarczona</option>
                                et;
                                break;
                            case 'wyslana':
                                echo<<<et
                                    <option value='przygotowanie' >przygotowanie</option>
                                    <option value='wyslana' selected>wyslana</option>
                                    <option value='dostarczona' >dostarczona</option>
                                et;
                                break;
                            case 'dostarczona':
                                echo<<<et
                                    <option value='przygotowanie' >przygotowanie</option>
                                    <option value='wyslana' >wyslana</option>
                                    <option value='dostarczona' selected>dostarczona</option>
                                et;
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                    echo<<<et
                                </select>
                                <input type='submit' name='submode' value='zmien'>
                            </form>
                        </div>
                        
                    et;
                    exit;
                }
            }
            if($_POST['submode'] == 'zmien'){
                $status = $_POST['status'];
                $zamowienie_id = $_POST['zamowienie_id'];
                $query="UPDATE zamowienie SET status = '$status' WHERE zamowienie_id = $zamowienie_id";
                $connect->query($query);
            }
        }

        $query = "SELECT * FROM zamowienie LEFT JOIN user USING(user_id) ORDER BY zamowienie_id";
        $result = $connect->query($query);
        echo "<table><tr><th>Zamowienie_id</th><th>user</th><th>data</th><th>platnosc</th><th>przesylka</th><th>status</th><th>modyfikuj</th><th>usun</th></tr>";

        while($row = $result->fetch_object()){
            echo<<<et
               
                <tr>
                    
                        <td>
                            $row->zamowienie_id
                            
                        </td>
                        <td>
                            $row->login
                        </td>
                        <td>
                            $row->data
                        </td>
                        <td>
                            $row->platnosc
                        </td>
                        <td>
                            $row->przesylka
                        </td>
                        <td>
                            $row->status
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='zamowienie_id' value='$row->zamowienie_id'>
                                <input type='submit' name='submode' value='modyfikuj'>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='zamowienie_id' value='$row->zamowienie_id'>
                                <input type='submit' name='submode' value='usun'>
                                
                            </form>  
                        </td>
                    
                </tr>
                
            et;
        }

        echo "</table>";

    
    }