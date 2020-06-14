<?php
// dodanie plikow
include_once 'baza_danych.php';
include_once 'klasa_zlecenia.php';

 
// pobranie polaczenia
$database = new Database();
$db = $database->getConnection();
 
// przekazanie polaczenia
$zlecenie = new Zlecenie($db);
include_once "navbar.php";
$page_title = "Dodaj Zlecenie";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='zlecenia.php' class='btn btn-warning pull-right'>Zobacz zlecenia</a>";
echo "</div>";
 
?>
<?php 
// po zatwierdzeniu formularza 
if($_POST){
 
    $zlecenie->adres = $_POST['adres'];
    $zlecenie->typ_prac = $_POST['typ_prac'];
    $zlecenie->metraz = $_POST['metraz'];
    $zlecenie->ustalona_cena = $_POST['ustalona_cena'];
 
   
    if($zlecenie->dodaj()){
        echo "<div class='alert alert-success'>Dodano nowe zlecenie.</div>";
    }
 
    
    else{
        echo "<div class='alert alert-danger'>Nie udało się dodać zlecenia</div>";
    }
}
?>
 
<!-- Formularz dodania zlecenia -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<div class="card">
 
    <table class='table table-dark table-hover table-bordered'>
 
        <tr>
            <td><strong>Adres</strong></td>
            <td><input type='text' name='adres' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Typ prac</strong></td>
            <td><input type='text' name='typ_prac' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Metraż(m<sup>2</sup>)</strong></td>
            <td><input type="text" name='metraz' class='form-control'></input></td>
        </tr>
 
        <tr>
            <td><strong>Ustalona cena (zł)</strong></td>
            <td><input type="text" name='ustalona_cena' class='form-control'></input></td>
        </tr>
 
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-success">Dodaj</button>
            </td>
        </tr>
 
    </table>
    </div>

    <script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
</form>
<?php
 
// stopka
include_once "layout_stopka.php";
?>