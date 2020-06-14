<?php
include_once "navbar.php";
$page_title = "Edytuj pracownika";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='pracownicy.php' class='btn btn-warning pull-right'>Zobacz Pracowników</a>";
echo "</div>";
 

include_once "layout_stopka.php";



$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 

include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';

 

$database = new Database();
$db = $database->getConnection();
 

$pracownik = new Pracownik($db);



$pracownik->id = $id;
 

$pracownik->pobierz_pracownika();
 
?>
<?php 

if($_POST){
 

    $pracownik->imie = $_POST['imie'];
    $pracownik->nazwisko = $_POST['nazwisko'];
    $pracownik->rola = $_POST['rola'];
    $pracownik->stanowisko = $_POST['stanowisko'];
    $pracownik->pensja = $_POST['pensja'];
    $pracownik->kod = $_POST['kod'];
    $pracownik->kontakt = $_POST['kontakt'];
 

    if($pracownik->edytuj()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Pracownik został zmieniony";
        echo "</div>";
    }
 

    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można edytować pracownika!";
        echo "</div>";
    }
}
?>
 
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
<div class="card">
    <table class='table table-dark table-hover  table-bordered'>
 
        <tr>
            <td><strong>Imię</strong></td>
            <td><input type='text' name='imie' value='<?php echo $pracownik->imie; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Nazwisko</strong></td>
            <td><input type='text' name='nazwisko' value='<?php echo $pracownik->nazwisko; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Rola</strong></td>
            <td><input type='text' name='rola' value='<?php echo $pracownik->rola; ?>' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Stanowisko</strong></td>
            
            <td><input type='text' name='stanowisko' value='<?php echo $pracownik->stanowisko; ?>' class='form-control' /></td>
            
        </tr>

        <tr>
            <td><strong>Pensja (zł)</strong></td>
            
            <td><input type='text' name='pensja' value='<?php echo $pracownik->pensja; ?>' class='form-control' /></td>
            
        </tr>

        <tr>
            <td><strong>Kod</strong></td>
            
            <td><input type='text' name='kod' value='<?php echo $pracownik->kod; ?>' class='form-control' readonly /></td>
            
        </tr>

        <tr>
            <td><strong>Kontakt</strong></td>
            
            <td><input type='text' name='kontakt' value='<?php echo $pracownik->kontakt; ?>' class='form-control' /></td>
            
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
