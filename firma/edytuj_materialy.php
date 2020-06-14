<?php

include_once "navbar.php";
$page_title = "Edytuj materiał";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='materialy.php' class='btn btn-warning pull-right'>Zobacz Materiały</a>";
echo "</div>";
 

include_once "layout_stopka.php";



$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 

include_once 'baza_danych.php';
include_once 'klasa_materialy.php';

 

$database = new Database();
$db = $database->getConnection();
 

$material = new Material($db);

 

$material->id = $id;
 

$material->pobierz_material();
 
?>
<?php 

if($_POST){
 
 
    
    $material->cena_jednostkowa = $_POST['cena_jednostkowa'];
 

    if($material->edytuj()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Materiał został zmieniony.";
        echo "</div>";
    }
 

    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można edytować materiału";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
<div class="card">
    <table class='table table-hover table-dark table-bordered '>
 
        <tr>
            <td><strong>Materiał</strong></td>
            <td><input type='text' name='material' value='<?php echo $material->material; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td><strong>Kategoria</strong></td>
            <td><input type='text' name='kategoria' value='<?php echo $material->kategoria; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td><strong>Cena jednostkowa(zł)</td>
            <td><input type='text' name='cena_jednostkowa' value='<?php echo $material->cena_jednostkowa; ?>' class='form-control' /></td>
        </tr>
 
       
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-success">Zatwierdź</button>
            </td>
        </tr>
 
    </table>
</div>
    <script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
</form>
<?php
 

?>