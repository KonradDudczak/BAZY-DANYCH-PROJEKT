<?php

if($_POST){

    include_once 'baza_danych.php';
    include_once 'klasa_zlecenia.php';

    $database = new Database();
    $db = $database->getConnection();
 

    $zlecenia = new Zlecenie($db);
     

    $id_przydzialu = $_POST['object_id_material'];


    

    if($zlecenia->usun_material_z_przydzialu($id_przydzialu)){
        echo "Przydział został usunięty.";
    }
     

    else{
        echo "Nie można usunąć przydziału!";
    }
}
?>