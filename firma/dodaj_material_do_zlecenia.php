<?php



include_once "navbar.php";
$page_title = "Dodaj materiał do zlecenia";
include_once "layout_naglowek.php";
include_once "navbar.php";

include_once 'baza_danych.php';
include_once 'klasa_materialy.php';
include_once 'klasa_zlecenia.php';
$database = new Database();
$db = $database->getConnection();



$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$material = new Material($db);
$zlecenie = new Zlecenie($db);

$zlecenie->id=$id;



$zlecenie->pobierz_zlecenie_do_przydzialu();

if($_POST){
    $material->id = $_POST['material']; 
    $ilosc = $_POST['ilosc'];
  
    
  
 
    if($material->dodaj_material_do_zlecenia($zlecenie->id, $ilosc)){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Dodano materiały";
        echo "</div>";
    }
 
   
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można dodać materiałów!";
        echo "</div>";
    }
}
?>
<?php
echo "<div class='right-button-margin'>";
    echo "<a href='przydzial_materialow.php' class='btn btn-warning pull-right'>Zobacz Przydziały</a>";
echo "</div>";
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
<div class="card">
    <table class='table table-dark table-hover table-bordered'>
 
        <tr>
            <td>Adres</td>
            <td><input type='text' name='adres' value='<?php echo $zlecenie->adres; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td>Typ prac</td>
            <td><input type='text' name='typ_prac' value='<?php echo $zlecenie->typ_prac; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td>Metraż (m<sup>2</sup>)</td>
            <td><input type="text" name='metraz' value='<?php echo $zlecenie->metraz; ?>' class='form-control' readonly></input></td>
        </tr>
 
        <tr>
            <td>Materiał</td>
            <td><?php

$stmt = $material->wylistuj_materialy_dla_zlecenia($zlecenie->id);
 

echo "<select class='form-control' name='material'>";
    echo "<option>Wybierz material</option>";
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "<option value='{$id}'>{$material} : {$kategoria}</option>";
    }
 
echo "</select>";
?></td>
            
        </tr>

        <tr>
            <td>Ilość</td>
            <td><input type="text" name='ilosc'  class='form-control' ></input></td>
        </tr>


        
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Dodaj</button>
            </td>
        </tr>
 
    </table>
    </div>

    
<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
</form>

<?php include_once 'layout_stopka.php';