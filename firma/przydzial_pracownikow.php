<?php


$page = isset($_GET['page']) ? $_GET['page'] : 1;
 



include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';
include_once 'klasa_zlecenia.php';



include_once "navbar.php";
$page_title = "Przydział pracowników";
include_once "layout_naglowek.php";
echo "<div class='right-button-margin'>
    <a href='#' class='btn btn-warning pull-right'>Tutaj możesz przydzielić pracownika do zlecenia</a>
</div>";

 

$database = new Database();
$db = $database->getConnection();
$pracownik  = new Pracownik ($db);
$zlecenie  = new Zlecenie ($db);
$stmt = $zlecenie->lista_zlecen_przydzial_pracownikow();
$num = $stmt->rowCount();

// naglowek strony

if ($num>0){

       
    echo "<div class='card'>";
    echo "<table class='table table-dark table-hover table-bordered'>";
        echo "<tr style='text-align:center;'>";
            echo "<th>Adres</th>";
            echo "<th>Typ prac</th>";
            echo "<th>Metraż (m<sup>2</sup>)</th>";
           
            echo "<th>Pracownik</th>";
            echo "<th>Stanowisko</th>";
            
            
            echo "</tr>";
       
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr style='text-align:center;'>";
              
                echo "<td>{$adres}</td>";
                echo "<td>{$typ_prac}</td>";
                echo "<td>{$metraz}</td>";
                echo "<td>";
                $id_wybranego_zlecenia = $id;
                $stmt2 = $pracownik->pobierz_pracownikow_do_zlecenia($id_wybranego_zlecenia);
                while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                    extract($row2);
                    echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td style='text-align:center;'>{$imie}  {$nazwisko}</td>";
                        echo "<td><a class='btn btn-success '>
                        <span class='glyphicon glyphicon-remove'></span> P
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";}
                        echo "</td>";

                    echo"<td>";
                    
                    $stmt2 = $pracownik->pobierz_pracownikow_do_zlecenia($id_wybranego_zlecenia);
                    while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                        extract($row2);
                        echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td>{$stanowisko}</td>";
                        echo "<td><a delete-id='{$id}' delete-zlecenie='{$id_wybranego_zlecenia}' class='btn btn-danger delete-object'>
                        <span class='glyphicon glyphicon-remove'></span> Usuń
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";
                        }
                        echo "</td>";
                        
                       

                        echo "<td>";
                        echo  "<a href='dodaj_pracownika_do_zlecenia.php?id={$id_wybranego_zlecenia}' class='btn btn-success left-margin'>
                        <span class='glyphicon glyphicon-edit'></span> +Dodaj Pracownika
                        </a>";
                        echo "</td>";

                    } 
                    echo "</table>" ; 
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
            var id_zlecenia = $(this).attr('delete-zlecenie');
         
            bootbox.confirm({
                message: "<h4>Czy chcesz usunąć tego pracownika z tej budowy?</h4>",
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
                        $.post('usun_pracownika_z_przydzialu.php', {
                            object_id: id,
                            object_zlecenie: id_zlecenia
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

                            
                    
                    
                       
 
                
               
                   
                   
                   
                      

                
               