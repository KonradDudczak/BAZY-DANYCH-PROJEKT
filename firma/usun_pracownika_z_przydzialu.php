<?php

if($_POST){
 

    include_once 'baza_danych.php';
    include_once 'klasa_pracownicy.php';
 

    $database = new Database();
    $db = $database->getConnection();
 
 
    $pracownik = new Pracownik($db);
     

    $pracownik->id = $_POST['object_id'];
    $id_aktywnego_zlecenia = $_POST['object_zlecenie'];
    
     

    if($pracownik->usun_pracownika_z_przydzialu($id_aktywnego_zlecenia)){
        echo "Przydział został usunięty.";
    }
     

    else{
        echo "Nie można usunąć przydziału!";
    }
}
?>