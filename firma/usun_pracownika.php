<?php

if($_POST){
 

    include_once 'baza_danych.php';
    include_once 'klasa_pracownicy.php';
 

    $database = new Database();
    $db = $database->getConnection();
 

    $pracownik = new Pracownik($db);
     
 
    $pracownik->id = $_POST['object_id'];
     

    if($pracownik->usun()){
        echo "Zlecenie zostało usunięte.";
    }
     
  
    else{
        echo "Nie można usunąć zlecenia!";
    }
}
?>