<?php


include_once "navbar.php";
$page_title = "Statystyki";
include_once "layout_naglowek.php";
$page = isset($_GET['page']) ? $_GET['page'] : 1;


include_once 'baza_danych.php';
include_once 'klasa_statystyki.php';
include_once 'klasa_zlecenia.php';
 
include_once "layout_stopka.php";
 

$database = new Database();
$db = $database->getConnection();

$zlecenie = new Zlecenie($db);
$statystyka = new Statystyki($db);

$stmt = $statystyka->pokaz_zlecenie_do_statystyk();
$num = $stmt->rowCount();



echo "<div class='right-button-margin'>
    <a href='finanse.php' class='btn btn-success pull-right'>Tutaj zobaczysz szczegóły finansowe</a>
</div>";
 
if($num>0){
 echo "<div class='card'>";
    echo "<table style='text-align: center;' class='table table-dark table-hover  table-bordered'>";
        echo "<tr>";
            echo "<th>Adres</th>";
            echo "<th>Typ prac</th>";
            echo "<th>Metraz (m<sup>2</sup>)</th>";
            echo "<th>Ustalona cena (zł)</th>";
            echo "<th>Koszty (zł)</th>";
            echo "<th>Liczba pracowników</th>";
            echo "<th>Przewidywany zysk (zł)</th>";
        echo "</tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$adres}</td>";
                echo "<td>{$typ_prac}</td>";
                echo "<td>{$metraz}</td>";
                echo "<td>{$ustalona_cena}</td>";

                $stmt2 = $statystyka->pobierz_koszt_zlecenia($id);
                $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
                extract($row2);
                echo "<td>{$koszt}</td>";

                $stmt3 = $statystyka->pobierz_liczbe_pracownikow($id);
                $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
                extract($row3);
                echo "<td>{$liczba}</td>";

                $zysk = $ustalona_cena - $koszt;
                echo "<td>{$zysk}</td>";

                
        }






                

        echo "</table>";
        echo "</div>";


     

}
else {

    echo "<div class='alert alert-info'>Aktualnie brak zleceń</div>";
}

?>
   <script> 
        $("table").fadeOut().delay(500).fadeIn();
        
        
          </script>
