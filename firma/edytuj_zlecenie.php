<?php

include_once "navbar.php";
$page_title = "Edytuj zlecenie";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='zlecenia.php' class='btn btn-warning pull-right'>Zobacz Zlecenia</a>";
echo "</div>";
 

include_once "layout_stopka.php";



$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 

include_once 'baza_danych.php';
include_once 'klasa_zlecenia.php';

 

$database = new Database();
$db = $database->getConnection();
 

$zlecenie = new Zlecenie($db);

 

$zlecenie->id = $id;
 

$zlecenie->pobierz_zlecenie();
 
?>
<?php 

if($_POST){
 
 
    $zlecenie->adres = $_POST['adres'];
    $zlecenie->typ_prac = $_POST['typ_prac'];
    $zlecenie->metraz = $_POST['metraz'];
    $zlecenie->ustalona_cena = $_POST['ustalona_cena'];
 

    if($zlecenie->edytuj()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Zlecenie zostało zmienione.";
        echo "</div>";
    }
 

    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można edytować zlecenia";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
<div class="card">
    <table class='table table-hover table-dark table-bordered '>
 
        <tr>
            <td><strong>Adres</strong></td>
            <td><input type='text' name='adres' value='<?php echo $zlecenie->adres; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Typ prac</strong></td>
            <td><input type='text' name='typ_prac' value='<?php echo $zlecenie->typ_prac; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Metraż m<sup>2</sup></strong></td>
            <td><input type='text' name='metraz' value='<?php echo $zlecenie->metraz; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Ustalona cena (zł)</strong></td>
            
            <td><input type='text' name='ustalona_cena' value='<?php echo $zlecenie->ustalona_cena; ?>' class='form-control' /></td>
            
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