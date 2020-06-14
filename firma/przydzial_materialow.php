<?php


$page = isset($_GET['page']) ? $_GET['page'] : 1;
 

$records_per_page = 5;
 

$from_record_num = ($records_per_page * $page) - $records_per_page;
 

include_once 'baza_danych.php';
include_once 'klasa_materialy.php';
include_once 'klasa_zlecenia.php';

include_once "navbar.php";
$page_title = "Przydział materiałów";
include_once "layout_naglowek.php";

echo "<div class='right-button-margin'>
    <a href='#' class='btn btn-success pull-right'>Tutaj możesz przydzielić materiały</a>
</div>";

 

$database = new Database();
$db = $database->getConnection();
$material = new Material ($db);
$material2 = new Material ($db);
$material3 = new Material ($db);
$material4 = new Material ($db);
$zlecenie2  = new Zlecenie ($db);
$stmt = $zlecenie2->lista_zlecen_przydzial_materialow();
$num = $stmt->rowCount();

// naglowek strony

if ($num>0){

    echo "<div class='card'>";
    echo "<table class='table table-dark  table-hover table-bordered'>";
        echo "<tr style='text-align:center;'>";
            echo "<th>Adres</th>";
            echo "<th>Typ prac</th>";
            echo "<th>Metraż (m<sup>2</sup>)</th>";
           
            echo "<th>Materiał</th>";
            echo "<th>Ilość</th>";
            echo "<th>Kategoria</th>";
            echo "<th>Koszt (zł)</th>";
            
            
            echo "</tr>";
       
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
           
            extract($row);
           
 
            echo "<tr style='text-align:center;'>";
              
                echo "<td>{$adres}</td>";
                echo "<td>{$typ_prac}</td>";
                echo "<td>{$metraz}</td>";
                echo "<td>";
                $id_wybranego_zlecenia = $id;
                $material = new Material ($db);
                
                $stmt2 = $material->pobierz_material_do_zlecenia($id_wybranego_zlecenia);
                while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                    extract($row2);
                    echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td style='text-align:center;'>{$material}</td>";
                        echo "<td><a class='btn btn-success '>
                        <span class='glyphicon glyphicon-remove'></span> P
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";}
                        echo "</td>";




                        echo"<td>";
                    
                    $stmt3 = $material2->pobierz_ilosc_materialu_do_zlecenia($id_wybranego_zlecenia);
                    while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                        extract($row3);
                        echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td>{$ilosc}</td>";
                        echo "<td><a delete-id-materialu='{$id}'  class='btn btn-danger delete-object'>
                        <span class='glyphicon glyphicon-remove'></span> Usuń
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";
                        }
                        echo "</td>";

                    echo"<td>";
                    
                    $stmt2 = $material3->pobierz_kategorie_materialu_do_zlecenia($id_wybranego_zlecenia);
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        extract($row2);
                        echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td>{$kategoria}</td>";
                        echo "<td><a class='btn btn-primary '>
                        <span class='glyphicon glyphicon-remove'></span> K
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";
                        }
                        echo "</td>";

                        echo "<td>";
                        $stmt5 = $material4->pokaz_koszt_dla_zlecenia($id_wybranego_zlecenia);
                        $sumaryczny_koszt = $stmt5->fetch(PDO::FETCH_ASSOC);
                        extract($sumaryczny_koszt);
                     
                       echo "{$koszt}";

                        
                        
                        
                        
                        
                        echo"</td>";
                        
                       

                        echo "<td>";
                        echo  "<a href='dodaj_material_do_zlecenia.php?id={$id_wybranego_zlecenia}' class='btn btn-success left-margin'>
                        <span class='glyphicon glyphicon-edit'></span> +Dodaj Materiał
                        </a>";
                        echo "</td>";

                        

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
                    // Bootbox
        $(document).on('click', '.delete-object', function(){
         
            var id = $(this).attr('delete-id-materialu');
         
         
            bootbox.confirm({
                message: "<h4>Czy chcesz usunąć tę porcję materiału ze zlecenia?</h4>",
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
                        $.post('usun_material_z_przydzialu.php', {
                            object_id_material: id
                            
                        }, function(data){
                            location.reload();
                        }).fail(function() {
                            alert('Nie można usunąć przydziału!');
                        });
                    }
                }
            });
         
            return false;
        });
        </script>

                            
                    
                    
                       
 
                
               
                   
                   
                   
                      

                
               
                            
                    
                    
                       
 
                
               
                   
                   
                   
                      

                
               