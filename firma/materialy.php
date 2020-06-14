<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;
 


 

include_once 'baza_danych.php';
include_once 'klasa_materialy.php';


$database = new Database();
$db = $database->getConnection();
 
$material = new Material($db);
$material2 = new Material($db);

 

$stmt = $material->pokaz_materialy();
$num = $stmt->rowCount();
include_once "navbar.php";
$page_title = "Materiały";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>
    <a href='#' class='btn btn-success pull-right'>Tutaj zobaczysz dostępne materiały</a>
</div>";



if($num>0){
    echo "<div class='card'>";
    echo "<table class='table table-dark table-hover  table-bordered'>";
        echo "<tr>";
            echo "<th>Materiał</th>";
            echo "<th>Kategoria</th>";
            echo "<th>Cena jednostkowa (zł)</th>";
            echo "<th></th>";
            
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$material}</td>";
                echo "<td>{$kategoria}</td>";
                echo "<td>{$cena_jednostkowa}</td>";
                echo "<td>
                 <a href='edytuj_materialy.php?id={$id}' class='btn btn-info left-margin'>
                <span class='glyphicon glyphicon-edit'></span> Edytuj
                </a></td>";
              
                
 
            echo "</tr>";
 
        }
 
    echo "</table>";
    echo "</div>";

?>



<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>

<?php



 
    }
else{
    echo "<div class='alert alert-info'>Brak materiałów w bazie!</div>";
}
 

include_once "layout_stopka.php";
?>