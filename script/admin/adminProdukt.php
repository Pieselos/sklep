<?php
    if(empty($_SESSION['admin'])){
        header("Location: http://localhost/sites/admin.php");
        exit;
    }else{
        $connect=mysqli_connect("localhost","root","","sklep");
        
        
        
        
        if(isset($_POST['submode'])){
            if($_POST['submode'] == 'usun'){
                $produkt_id = $_POST['produkt_id'];
                
                $query = "DELETE FROM produkt WHERE produkt_id = $produkt_id";
                
                $connect->query($query);
            }
            if($_POST['submode'] == 'modyfikuj'){
                $produktId = $_POST['produkt_id'];
                $connect=mysqli_connect("localhost","root","","sklep");
                $query = "SELECT * FROM produkt WHERE produkt_id = $produktId";
                $result = $connect->query($query)->fetch_object();
                $nazwa_produkt = $result->nazwa;
                $kategoria_produkt = $result->kategoria_id;
                $producent_produkt = $result->producent_id;
                $cena_brutto = $result->cena_brutto;
                $opis = $result->opis;
                $ilosc_magazyn = $result->ilosc_magazyn;
                echo<<<et
                    <div>
                        <h1>Zmień dane</h1>
                        <form method='post'>
                            <input type='hidden' name='produkt_id' value='$produktId'>
                            <input type='number' name='cena_brutto' value='$cena_brutto'>
                            <input name='nazwa_produkt' value='$nazwa_produkt'>
                            <input name='opis' value='$opis'>
                            <input name='ilosc_magazyn' value ='$ilosc_magazyn'>
                            <input type='submit' name='submode' value='zmien'>
                        </form>
                    </div>
                    
                et;
                exit;
            }
            if($_POST['submode'] == 'zmien'){
                $nazwa_produkt = $_POST['nazwa_produkt'];
                $produkt_id = $_POST['produkt_id'];
                $cena_brutto = $_POST['cena_brutto'];
                $opis = $_POST['opis'];
                $ilosc_magazyn = $_POST['ilosc_magazyn'];
                $query="UPDATE produkt SET nazwa = '$nazwa_produkt', cena_brutto = $cena_brutto, opis = '$opis', ilosc_magazyn = $ilosc_magazyn WHERE produkt_id = $produkt_id";
                // echo $query;
                $connect->query($query);
            }
        }

        $query = "SELECT produkt.nazwa AS nazwa_produkt, produkt_id, nazwa_kategoria, cena_brutto, opis, producent.nazwa AS nazwa_producent, ilosc_magazyn FROM produkt JOIN kategoria USING(kategoria_id) JOIN producent USING(producent_id) ORDER BY produkt_id DESC";
        $result = $connect->query($query);
        echo "<table><tr> <th>produkt_id</th> <th>nazwa_produkt</th> <th>kategoria</th> <th>producent</th> <th>cena_brutto</th> <th>Opis</th> <th>Ilosc_magazyn</th> <th>modyfikuj</th> <th>usun</th> </tr>";

        while($row = $result->fetch_object()){
            echo<<<et
               
                <tr>
                    
                        <td>
                            $row->produkt_id
                        </td>
                        <td>
                            $row->nazwa_produkt
                        </td>
                        <td>
                            $row->nazwa_kategoria
                        </td>
                        <td>
                            $row->nazwa_producent
                        </td>
                        <td>
                            $row->cena_brutto
                        </td>
                        <td>
                            $row->opis
                        </td>
                        <td>
                            $row->ilosc_magazyn
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='produkt_id' value='$row->produkt_id'>
                                <input type='submit' name='submode' value='modyfikuj'>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='produkt_id' value='$row->produkt_id'>
                                <input type='submit' name='submode' value='usun'>
                                
                            </form>  
                        </td>
                    
                </tr>
                
            et;
        }

        echo "</table>";

    }