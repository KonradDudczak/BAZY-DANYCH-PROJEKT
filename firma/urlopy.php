<?php


$page = isset($_GET['page']) ? $_GET['page'] : 1;
 


 

include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';
include_once 'klasa_urlop.php';



 

$database = new Database();
$db = $database->getConnection();
 
$pracownik = new Pracownik($db);
$stmt = $pracownik->lista_pracownikow_urlopy();
$num = $stmt->rowCount();

$urlopy = new Urlop($db);


include_once "navbar.php";
// naglowek strony
$page_title = "Urlopy";
include_once "layout_naglowek.php";

if($num>0){
    echo "<div class='card'>";
    echo "<table class='table  table-dark table-hover table-bordered'>";
        echo "<tr style='text-align:center;'>";
            echo "<th>Imię</th>";
            echo "<th>Nazwisko</th>";
            echo "<th>Stanowisko</th>";
           
            echo "<th>Rodzaj</th>";
            echo "<th>Do kiedy</th>";
            
            echo "</tr>";
       
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr style='text-align:center;'>";
                echo "<td style='text-align:center;'>{$imie}</td>";
                echo "<td>{$nazwisko}</td>";
                echo "<td>{$stanowisko}</td>";
                echo "<td>";
                $id_wybranego_pracownika = $id;
                $stmt2 = $urlopy->pobierz_urlopy($id_wybranego_pracownika);
                while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                    extract($row2);
                    echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td style='text-align:center;'>{$opis}</td>";
                        echo "<td><a class='btn btn-warning '>
                        <span class='glyphicon glyphicon-remove'></span> ZW
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";}
                        echo "</td>";

                    echo"<td>";
                    
                    $stmt2 = $urlopy->pobierz_urlopy($id_wybranego_pracownika);
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        extract($row2);
                        echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td>{$do_kiedy}</td>";
                        echo "<td><a delete-id='{$id}' class='btn btn-danger delete-object'>
                        <span class='glyphicon glyphicon-remove'></span> Usuń
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";
                        }
                        echo "</td>";
                        
                       

                        echo "<td>";
                        echo  "<a href='dodaj_urlop.php?id={$id_wybranego_pracownika}' class='btn btn-success left-margin'>
                        <span class='glyphicon glyphicon-edit'></span> +Dodaj
                        </a>";
                        echo "</td>";

                    }
                    echo "</table>";
                    echo "</div>";
                     
                    
                       
 
                
                    
                    
                    include_once "layout_stopka.php";
                   
                   
                      

                }

                
                 

?>


<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
            <script>
         
$(document).on('click', '.delete-object', function(){
 
    var id = $(this).attr('delete-id');
 
    bootbox.confirm({
        message: "<h4>Czy chcesz usunąć urlop?</h4>",
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
                $.post('usun_urlop.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Nie można usunąć urlopu!');
                });
            }
        }
    });
 
    return false;
});
</script>
    
                    
                    
                   
                    
                    
                  
                
                    

                        

                     
                     
                    
                      
              
                      