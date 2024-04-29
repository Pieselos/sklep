<?php

echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
$DR = $_SERVER['DOCUMENT_ROOT'];


if(isset($_POST["produktNazwa"])){
    $connect=mysqli_connect("localhost","root","","sklep");
    
    if(isset($_FILES['zdjGlowne'])){
        echo "Typ pliku: ".$_FILES['zdjGlowne']['type']."<br>";
        echo "Rozmiar pliku: ".$_FILES['zdjGlowne']['size']."<br>";
        echo "Nazwa pliku: ".$_FILES['zdjGlowne']['name']."<br>";
        echo "Nazwa tymczasowa: ".$_FILES['zdjGlowne']['tmp_name']."<br>";
        echo "Błędy: ".$_FILES['zdjGlowne']['error']."<br>";
        $file_name = $_FILES['zdjGlowne']['name'];
        
    
        $tmp_name = $_FILES['zdjGlowne']['tmp_name'];
    
        $target_dir = "$DR/img/";
        $target_file = $target_dir.$file_name;
        //zdefiniowanie tablicy błędów wykonania skryptu
        $errors = array();
        //sprawdzenie rozszerzenia pliku
        $file_name_array =explode('.', $file_name);
        $file_ext = strtolower(end($file_name_array));
        $extensions = array("jpeg","jpg","jfif","jpe","img","webp");
        if(in_array($file_ext, $extensions) === false){
            $errors[]="Błędne rozszerzenie.";
        }
       
        $fileNameOnDb = date('Y-m-d-H_i_s')."-".$_POST['produktNazwa']."-zdjecieGlowne.".$file_ext;

        //wypisanie ewentualnych błędów
        echo "<pre>";
        print_r($errors);
        echo "</pre>";
        //wysłanie pliku na serwer
        if(!$errors){
            echo $target_dir.$fileNameOnDb;
            if (move_uploaded_file($tmp_name, $target_dir.$fileNameOnDb)) {
                echo "Plik ".$fileNameOnDb. " został wysłany na serwer.";
            } else {
                echo "Nie udało się wysłać pliku.";
            }
        }
    }

    if(isset($_FILES['zdjecia'])){
        $files_number = count($_FILES['zdjecia']['name']);
        for($i=0; $i<$files_number; $i++){
            echo "<hr>Przesyłam ";
            echo $i+1;
            echo " plik<br>";

            echo "Typ pliku: ".$_FILES['zdjecia']['type'][$i]."<br>";
            echo "Rozmiar pliku: ".$_FILES['zdjecia']['size'][$i]."<br>";
            echo "Nazwa pliku: ".$_FILES['zdjecia']['name'][$i]."<br>";
            echo "Nazwa tymczasowa: ".$_FILES['zdjecia']['tmp_name'][$i]."<br>";
            echo "Błędy: ".$_FILES['zdjecia']['error'][$i]."<br>";
            $file_name = $_FILES['zdjecia']['name'][$i];
            


            $tmp_name = $_FILES['zdjecia']['tmp_name'][$i];
            
            $target_dir = "$DR/img/";
            $target_file = $target_dir.$file_name;
            //zdefiniowanie tablicy błędów wykonania skryptu
            $errors = array();
            //sprawdzenie rozszerzenia pliku
            $file_name_array =explode('.', $file_name);
            $file_ext = strtolower(end($file_name_array));
            $extensions = array("jpeg","jpg","jfif","jpe","img","webp");
            if(in_array($file_ext, $extensions) === false){
                $errors[]="Błędne rozszerzenie, wybierz plik jpeg, jpg lub png.";
            }
            // sprawdzenie rozmiaru pliku
            
            //sprawdzenie, czy plik już istnieje w danej lokalizacji
            if(file_exists($target_file)) {
                $errors[]="Taki plik już istnieje.";
            }

            $fileNameOnDb = date('Y-m-d-H_i_s')."-".$_POST['produktNazwa']."-$i.".$file_ext;
            
            
            //wypisanie ewentualnych błędów
            echo "<pre>";
            print_r($errors);
            echo "</pre>";
            //wysłanie pliku na serwer
            if(!$errors){
                if (move_uploaded_file($tmp_name, $target_dir.$fileNameOnDb)) {
                echo "Plik ".$fileNameOnDb. " został wysłany na serwer.";
                } else {
                echo "Nie udało się wysłać pliku.";
                }
            }
            
            $errors = array();
        }
    }





    //przetestować, zrobić wysyłanie plików dal zdjecia, stworzyć zapytanie, przetestować ostatecznie

}
