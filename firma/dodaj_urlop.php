<?php


include_once "navbar.php";
$page_title = "Dodaj urlop dla pracownika";
include_once "layout_naglowek.php";

include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';
include_once 'klasa_urlop.php';
$database = new Database();
$db = $database->getConnection();



$id =($_GET['id']);

$pracownik = new Pracownik($db);
$urlop = new Urlop($db);

$pracownik->id=$id;


$pracownik->pobierz_pracownika_do_urlopu();

if($_POST){
 
  
    $urlop->opis = $_POST['opis'];
    $urlop->id_pracownika=$id;
    $urlop->do_kiedy = $_POST['do_kiedy'];
  
 
    if($urlop->dodaj()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Przypisano urlop pracownikowi";
        echo "</div>";
    }
 

    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można przypisać urlopu pracownikowi!";
        echo "</div>";
    }
}
?>
<?php
echo "<div class='right-button-margin'>";
    echo "<a href='urlopy.php' class='btn btn-warning pull-right'>Zobacz Urlopy</a>";
echo "</div>";
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
<div class="card">
    <table class='table table-dark table-hover table-bordered'>
 
        <tr>
            <td>Imię</td>
            <td><input type='text' name='imie' value='<?php echo $pracownik->imie; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td>Nazwisko</td>
            <td><input type='text' name='nazwisko' value='<?php echo $pracownik->nazwisko; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td>Stanowisko</td>
            <td><input type="text" name='stanowisko' value='<?php echo $pracownik->stanowisko; ?>' class='form-control' readonly></input></td>
        </tr>
 
        <tr>
            <td>Opis urlopu</td>
            <td><input type="text" name='opis' class='form-control'></input></td>
            
        </tr>

        <tr>
            <td>Do kiedy</td>
            <td><input type="date" name='do_kiedy' class='form-control'></input></td>
            
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