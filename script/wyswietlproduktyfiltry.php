<?php




$connect=mysqli_connect("localhost","root","","sklep");
$query = "SELECT * FROM produkt JOIN kategoria USING(kategoria_id) WHERE ";

// Tworzenie zapytania

if(isset($_GET["produktKategoria"] )){
    $szukanaKategoriaID = $_GET["produktKategoria"];
    $query = $query."kategoria_id=$szukanaKategoriaID AND ";
}

if(isset($_GET["produktProducent"])){
    $producentID = $_GET["produktProducent"];
    $query = $query."producent_id=$producentID AND ";
}

if(isset($_GET["pmin"])){
    if($_GET["pmin"] != ''){
        $cenaMinimalna = $_GET["pmin"];
        $query = $query."cena_brutto >= $cenaMinimalna AND ";

    }
    
}
if(isset($_GET["pmax"])){
    if($_GET["pmin"] != ''){
        $cenaMaksymalna = $_GET["pmax"];
        $query = $query."cena_brutto <= $cenaMaksymalna AND ";
    }
}
if(isset($_GET["ava"])){
    if($_GET["ava"]=='on'){
        $query = $query."ilosc_magazyn > 0";
    }
    
}

// Poprawianie zapytania 

if(str_ends_with($query,"AND ")){
    $query = substr($query,0,-4);
    
}

if(str_ends_with($query,"WHERE ")){
    $query = substr($query,0,-6);
    
}



echo $query;

$lista = $connect->query($query);


$domena = "localhost";
    while($row = $lista->fetch_object()){
        

        echo<<<et

            <div> 
            
                <li class="card bg-dark" style="width: 18rem;">
                    <a class="aFordiv" href="/sites/produkt.php?id=$row->produkt_id">
                        <img src="http://$domena/img/$row->zdj_glowne" class="card-img-top" alt="zdjęcie produktu">
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

//upofrządkować dane + testy 



$connect->close();
