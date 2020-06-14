<?php
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 


 

include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';

 

$database = new Database();
$db = $database->getConnection();
 
$pracownik = new Pracownik($db);

 

$stmt = $pracownik->pokaz_pracownika();
$num = $stmt->rowCount();
include_once "navbar.php";

$page_title = "Pracownicy";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>
    <a href='dodaj_pracownika.php' class='btn btn-success pull-right'>+Dodaj Pracownika</a>
</div>";



if($num>0){
       
    echo "<div class='card'>";
    echo "<table class='table table-dark table-hover table-bordered'>";
        echo "<tr>";
            echo "<th>Imię</th>";
            echo "<th>Nazwisko</th>";
            echo "<th>Rola</th>";
            echo "<th>Stanowisko</th>";
            echo "<th>Pensja (zł)</th>";
            echo "<th>Kod</th>";
            echo "<th>Kontakt</th>";

            echo "<th>Operacje</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$imie}</td>";
                echo "<td>{$nazwisko}</td>";
                echo "<td>{$rola}</td>";
                echo "<td>{$stanowisko}</td>";
                echo "<td>{$pensja}</td>";
                echo "<td>{$kod}</td>";
                echo "<td>{$kontakt}</td>";
                   
               echo "</td>";
 
                echo "<td>";



            echo "<a href='edytuj_pracownika.php?id={$id}' class='btn btn-info left-margin'>
            <span class='glyphicon glyphicon-edit'></span> Edytuj
            </a>

            <a delete-id='{$id}' class='btn btn-danger delete-object'>
            <span class='glyphicon glyphicon-remove'></span> Usuń
            </a>";
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
    echo "</div>";

?>


<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>


<?php


}

else{
    echo "<div class='alert alert-info'>Aktualnie brak pracowników w bazie.</div>";
}

include_once "layout_stopka.php";
?>

<script>

$(document).on('click', '.delete-object', function(){
 
    var id = $(this).attr('delete-id');
 
    bootbox.confirm({
        message: "<h4>Czy chcesz usunąć pracownika i wszystkie z nim powiązania ?</h4>",
        buttons: {
            confirm: {
                label: '<span class="glyphicon glyphicon-ok"></span> Tak',
                className: 'btn-danger'
            },
            cancel: {
                label: '<span class="glyphicon glyphicon-remove"></span> Nie',
                className: 'btn-primary'
            }
        },
        callback: function (result) {
 
            if(result==true){
                $.post('usun_pracownika.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Nie można usunąć pracownika!');
                });
            }
        }
    });
 
    return false;
});
</script>