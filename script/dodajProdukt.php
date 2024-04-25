<?php

echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";


if(isset($_POST["produktNazwa"])){
    $connect=mysqli_connect("localhost","root","","sklep");
    
    if(isset($_FILES['images'])){
        echo "Typ pliku: ".$_FILES['images']['type']."<br>";
        echo "Rozmiar pliku: ".$_FILES['images']['size']."<br>";
        echo "Nazwa pliku: ".$_FILES['images']['name']."<br>";
        echo "Nazwa tymczasowa: ".$_FILES['images']['tmp_name']."<br>";
        echo "Błędy: ".$_FILES['images']['error']."<br>";
        $file_name = $_FILES['images']['name'];
        
    
        $tmp_name = $_FILES['images']['tmp_name'];
    
        $target_dir = "img/";
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
       
        $fileNameOnDb = date('Y-m-d H:i:s').$_POST['produktNazwa']."zdjecieGlowne".$file_ext;

        //wypisanie ewentualnych błędów
        echo "<pre>";
        print_r($errors);
        echo "</pre>";
        //wysłanie pliku na serwer
        if(!$errors)
        if (move_uploaded_file($tmp_name, $target_dir.$fileNameOnDb)) {
            echo "Plik ".$fileNameOnDb. " został wysłany na serwer.";
        } else {
            echo "Nie udało się wysłać pliku.";
        }
    }
    //przetestować, zrobić wysyłanie plików dal zdjecia, stworzyć zapytanie, przetestować ostatecznie

}
