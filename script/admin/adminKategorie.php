<?php
    if(empty($_SESSION['admin'])){
        header("Location: http://localhost/sites/admin.php");
        exit;
    }else{
        $connect=mysqli_connect("localhost","root","","sklep");
        
        
        
        
        if(isset($_POST['submode'])){
            if($_POST['submode'] == 'usun'){
                $kategoria_id = $_POST['kategoria_id'];
                
                $query = "DELETE FROM kategoria WHERE kategoria_id = $kategoria_id";
                
                $connect->query($query);
            }
            if($_POST['submode'] == 'modyfikuj'){
                $kategoriaId = $_POST['kategoria_id'];
                $connect=mysqli_connect("localhost","root","","sklep");
                $query = "SELECT * FROM kategoria WHERE kategoria_id = $kategoriaId";
                $nazwa_kategorii = $connect->query($query)->fetch_object()->nazwa_kategoria;
                echo<<<et
                    <div>
                        <h1>Zmień dane</h1>
                        <form method='post'>
                            <input type='hidden' name='kategoria_id' value='$kategoriaId'>
                        
                            <input name='nazwa_kategorii' value='$nazwa_kategorii'>
                            <input type='submit' name='submode' value='zmien'>
                        </form>
                    </div>
                    
                et;
                exit;
            }
            if($_POST['submode'] == 'zmien'){
                $nazwa_kategorii = $_POST['nazwa_kategorii'];
                $kategoria_id = $_POST['kategoria_id'];
                $query="UPDATE kategoria SET nazwa_kategoria = '$nazwa_kategorii' WHERE kategoria_id = $kategoria_id";
                $connect->query($query);
            }
        }

        $query = "SELECT * FROM kategoria ORDER BY nazwa_kategoria";
        $result = $connect->query($query);
        echo "<table><tr><th>Kategoria_id</th><th>nazwa_kategorii</th><th>modyfikuj</th><th>usun</th></tr>";

        while($row = $result->fetch_object()){
            echo<<<et
               
                <tr>
                    
                        <td>
                            $row->kategoria_id
                            
                        </td>
                        <td>
                            $row->nazwa_kategoria
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='kategoria_id' value='$row->kategoria_id'>
                                <input type='submit' name='submode' value='modyfikuj'>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='kategoria_id' value='$row->kategoria_id'>
                                <input type='submit' name='submode' value='usun'>
                                
                            </form>  
                        </td>
                    
                </tr>
                
            et;
        }

        echo "</table>";

    }