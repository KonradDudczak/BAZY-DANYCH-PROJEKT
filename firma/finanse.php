<?php



include_once "navbar.php";
$page_title = "Szczegóły działalności";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>";
    echo "<a href='#' class='btn btn-danger pull-right'>Aktualnie</a>";
echo "</div>";
 

include_once "layout_stopka.php";

$page = isset($_GET['page']) ? $_GET['page'] : 1;
 



include_once 'baza_danych.php';
include_once 'klasa_statystyki.php';

$database = new Database();
$db = $database->getConnection();

$statystyka = new Statystyki($db);

?>
    <div class="card">
    <table class="table table-hover table-dark table-bordered " style = "text-align: center;">
 
        <tr>
            <td><strong>Aktualne zlecenia:</strong></td>
            <td><?php echo $statystyka->pobierz_liczbe_zlecen();;?></td>
        </tr>
 
        <tr>
            <td><strong>Zatrudniasz:</strong></td>
            <td><?php echo $statystyka->pobierz_wszystkich_pracownikow();?> pracowników</td>
        </tr>

        <tr>
            <td><strong>Aktualne koszty materiałowe:</strong></td>
            <td><?php echo $statystyka->pobierz_koszty_materialowe();?> zł</td>
        </tr>

        <tr>
            <td><strong>Przewidywany przychód:</strong></td>
            <td><?php echo $statystyka->pobierz_przewidywany_przychod();?> zł</td>
        </tr>

        <tr>
            <td><strong>Wypłaty pracowników:</strong></td>
            <td><?php echo $statystyka->pobierz_kwote_wyplat();?> zł</td>
        </tr>
 
       
 
        
 
        
 
    </table>
    </div>
    
<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
