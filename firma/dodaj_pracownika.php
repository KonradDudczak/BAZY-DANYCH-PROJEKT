<?php
// dodanie plikow
include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';

 
// pobranie polaczenia
$database = new Database();
$db = $database->getConnection();
 
// przekazanie polaczenia
$pracownik = new Pracownik($db);
include_once "navbar.php";
$page_title = "Dodaj Pracownika";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='pracownicy.php' class='btn btn-warning pull-right'>Zobacz Pracowników</a>";
echo "</div>";
 
?>
<?php 
// po zatwierdzeniu formularza 
if($_POST){
 

    $pracownik->imie = $_POST['imie'];
    $pracownik->nazwisko = $_POST['nazwisko'];
    $pracownik->rola = $_POST['rola'];
    $pracownik->stanowisko = $_POST['stanowisko'];
    $pracownik->pensja = $_POST['pensja'];
    $pracownik->kod = $_POST['kod'];
    $pracownik->kontakt = $_POST['kontakt'];
 
 
    if($pracownik->dodaj()){
        echo "<div class='alert alert-success'>Dodano nowego pracownika.</div>";
    }
 
    
    else{
        echo "<div class='alert alert-danger'>Nie udało się dodać pracownika</div>";
    }
}


?>
<!-- Formularz dodania zlecenia -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="card">
    <table class="table table-dark table-hover table-bordered">
 
        <tr>
            <td><strong>Imię</strong></td>
            <td><input type='text' name='imie' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Nazwisko</strong></td>
            <td><input type='text' name='nazwisko' class='form-control' /></td>
        </tr>
 
        <tr>
            <td><strong>Rola (kierownik,brygadzista,pracownik)</strong></td>
            <td><input type='text' name='rola' class='form-control'  /></td>
        </tr>
 
        <tr>
            <td><strong>Stanowisko</strong></td>
            <td><input type='text' name='stanowisko' class='form-control' /></td>
        </tr>

        <tr>
            <td><strong>Pensja (zł)</strong></td>
            <td><input type='text' name='pensja' class='form-control' />  </td>
        </tr>

        <tr>
            <td><strong>Kod</strong></td>
            <td><input type='text' name='kod' class='form-control' />  </td>
        </tr>

        <tr>
            <td><strong>Kontakt</strong></td>
            <td><input type='text' name='kontakt' class='form-control' />  </td>
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