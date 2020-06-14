<?php

$page = isset($_GET['page']) ? $_GET['page'] : 1;
 


 

include_once 'baza_danych.php';
include_once 'klasa_zlecenia.php';

 

$database = new Database();
$db = $database->getConnection();
 
$zlecenie = new Zlecenie($db);

include_once "navbar.php"; 

$stmt = $zlecenie->pokaz_zlecenie();
$num = $stmt->rowCount();

$page_title = "Zlecenia";
include_once "layout_naglowek.php";
 
echo "<div class='right-button-margin'>
    <a href='dodaj_zlecenie.php' class='btn btn-success pull-right'>+Dodaj Zlecenie</a>
</div>";


if($num>0){
   
    echo "<div class='card'>";
    echo "<table class='table table-dark table-hover table-bordered  '>";
        echo "<tr>";
            echo "<th>Adres</th>";
            echo "<th>Typ prac</th>";
            echo "<th>Metraz (m<sup>2</sup>)</th>";
            echo "<th>Ustalona cena (zł)</th>";
            echo "<th>Operacje</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$adres}</td>";
                echo "<td>{$typ_prac}</td>";
                echo "<td>{$metraz}</td>";
                echo "<td>{$ustalona_cena}</td>";
                
                   
               
 
                echo "<td>";
 


            echo "<a href='edytuj_zlecenie.php?id={$id}' class='btn btn-info left-margin'>
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
    echo "<div class='alert alert-info'>Aktualnie brak zleceń</div>";
}
 
// stopka
include_once "layout_stopka.php";
?>

<script>

$(document).on('click', '.delete-object', function(){
 
    var id = $(this).attr('delete-id');
 
    bootbox.confirm({
        message: "<h4>Czy chcesz usunąć zlecenie i wszystkie z nim powiązania?</h4>",
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
                $.post('usun_zlecenie.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Nie można usunąć zlecenia!');
                });
            }
        }
    });
 
    return false;
});
</script>