<?php
    if(empty($_SESSION['admin'])){
        header("Location: http://localhost/sites/admin.php");
        exit;
    }else{
        $connect=mysqli_connect("localhost","root","","sklep");
        
        
        
        
        if(isset($_POST['submode'])){
            if($_POST['submode'] == 'usun'){
                $producent_id = $_POST['producent_id'];
                
                $query = "DELETE FROM producent WHERE producent_id = $producent_id";
                
                $connect->query($query);
            }
            if($_POST['submode'] == 'modyfikuj'){
                $producentId = $_POST['producent_id'];
                $connect=mysqli_connect("localhost","root","","sklep");
                $query = "SELECT * FROM producent WHERE producent_id = $producentId";
                $nazwa_producenta = $connect->query($query)->fetch_object()->nazwa;
                echo<<<et
                    <div>
                        <h1>Zmień dane</h1>
                        <form method='post'>
                            <input type='hidden' name='producent_id' value='$producentId'>
                        
                            <input name='nazwa_producenta' value='$nazwa_producenta'>
                            <input type='submit' name='submode' value='zmien'>
                        </form>
                    </div>
                    
                et;
                exit;
            }
            if($_POST['submode'] == 'zmien'){
                $nazwa_producenta = $_POST['nazwa_producenta'];
                $producent_id = $_POST['producent_id'];
                $query="UPDATE producent SET nazwa = '$nazwa_producenta' WHERE producent_id = $producent_id";
                $connect->query($query);
            }
        }

        $query = "SELECT * FROM producent ORDER BY nazwa";
        $result = $connect->query($query);
        echo "<table><tr><th>producent_id</th><th>nazwa_producenta</th><th>modyfikuj</th><th>usun</th></tr>";

        while($row = $result->fetch_object()){
            echo<<<et
               
                <tr>
                    
                        <td>
                            $row->producent_id
                            
                        </td>
                        <td>
                            $row->nazwa
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='producent_id' value='$row->producent_id'>
                                <input type='submit' name='submode' value='modyfikuj'>
                            </form>
                        </td>
                        <td>
                            <form method="post">
                                <input type='hidden' name='producent_id' value='$row->producent_id'>
                                <input type='submit' name='submode' value='usun'>
                                
                            </form>  
                        </td>
                    
                </tr>
                
            et;
        }

        echo "</table>";

    }