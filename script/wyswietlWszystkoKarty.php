<?php

    $connect=mysqli_connect("localhost","root","","sklep");
    $query = "SELECT * FROM produkt JOIN kategoria USING(kategoria_id)";
    $result = $connect->query($query);
    $domena = "localhost";
    while($row = $result->fetch_object()){
        echo "<pre>";
        print_r($row);
        echo "</pre>";

        echo<<<et

            <div> 
            
                <li class="card bg-dark" style="width: 18rem;">
                    <a class="aFordiv" href="/sites/produkt.php?id=$row->produkt_id">
                        <img src="$domena/img/$row->zdj_glowne" class="card-img-top" alt="zdjęcie produktu">
                        <div class="card-body">
                            <h5 class="card-title">$row->nazwa</h5>
                            <p class="card-text">$row->nazwa_kategoria</p>
                            <p class="card-text">$row->cena_brutto</p>
                        </div>
                    </a>
                </li>
            
            </div>



        et;
    }
