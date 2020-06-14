<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'baza_danych.php';
    include_once 'klasa_urlop.php';
 

    $database = new Database();
    $db = $database->getConnection();
 

    $urlop = new Urlop($db);
     

    $urlop->id = $_POST['object_id'];
    
     
  
    if($urlop->usun()){
        echo "Urlop został usunięty.";
    }
     

    else{
        echo "Nie można usunąć urlopu!";
    }
}
?>