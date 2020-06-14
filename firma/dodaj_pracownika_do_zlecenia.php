<?php


include_once "navbar.php";
$page_title = "Dodaj pracownika do zlecenia";
include_once "layout_naglowek.php";

include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';
include_once 'klasa_zlecenia.php';
$database = new Database();
$db = $database->getConnection();



$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

$pracownik = new Pracownik($db);
$zlecenie = new Zlecenie($db);

$zlecenie->id=$id;



$zlecenie->pobierz_zlecenie_do_przydzialu();

if($_POST){
    $pracownik->id = $_POST['pracownik']; 
    
    
  
 

    if($pracownik->dodaj_pracownika_do_zlecenia($zlecenie->id)){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Przypisano pracownika";
        echo "</div>";
    }
 
    
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można przypisać pracownika!";
        echo "</div>";
    }
}
?>
<?php
echo "<div class='right-button-margin'>";
    echo "<a href='przydzial_pracownikow.php' class='btn btn-warning pull-right'>Zobacz Przydziały</a>";
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
            <td>Pracownik</td>
            <td><?php

$stmt = $pracownik->wylistuj_pracownikow_dla_zlecenia($zlecenie->id);
 

echo "<select class='form-control' name='pracownik'>";
    echo "<option>Wybierz pracownika</option>";
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "<option value='{$id}'>{$imie} {$nazwisko}, {$stanowisko}</option>";
    }
 
echo "</select>";
?></td>
            
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