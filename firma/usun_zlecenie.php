<?php

if($_POST){
 

    include_once 'baza_danych.php';
    include_once 'klasa_zlecenia.php';
 

    $database = new Database();
    $db = $database->getConnection();
 

    $zlecenie = new Zlecenie($db);
     

    $zlecenie->id = $_POST['object_id'];
    
     

    if($zlecenie->usun()){
        echo "Zlecenie zostało usunięte.";
    }
     

    else{
        echo "Nie można usunąć zlecenia!";
    }
}
?>