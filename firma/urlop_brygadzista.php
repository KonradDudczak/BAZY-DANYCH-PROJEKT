<?php


$id = $_GET['id'];
 

 


include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';
include_once 'klasa_zlecenia.php';
include_once 'klasa_urlop.php';


?>
<!DOCTYPE html>
<html lang="pl">
<head>
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
 
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
  
  
    <link rel="stylesheet" href="navbar.css" />
  
</head>




<body>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="#" class="navbar-brand">Brygadzista</a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-right">

      <li class="active">
          <a>Dzisiaj mamy:   <?php echo date('d-m-Y H:i',time()); ?></a>
        </li>
        <li>
          <?php echo "<a href='./dashboard_brygadzista.php?id={$id}'>Dane personalne</a>";?>
        </li>
        <li>
        <?php echo "<a href='./pracownicy_brygadzisty.php?id={$id}'>Pracownicy dla twoich zleceń</a>";?>
        </li>
        <li>
        <?php echo "<a href='./przydzial_materialow_brygadzista.php?id={$id}'>Przydział materiałów</a>";?>
        </li>
        <li>
        <?php echo "<a href='./urlop_brygadzista.php?id={$id}'>Urlopy</a>";?>
        </li>
        
        <li class="active">
          <a href="logout.php">Wyloguj</a>
        </li>
      </ul>
    </nav>
  </div>
</header>



<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
<script>$(window).scroll(function() {
  if ($(document).scrollTop() > 50) {
    $('nav').addClass('shrink');
  } else {
    $('nav').removeClass('shrink');
  }
});


</script>

</body>
</html>
<?php
$page_title = "Urlopy";
include_once "layout_naglowek.php";


 
$database = new Database();
$db = $database->getConnection();
$pracownik  = new Pracownik ($db);
$urlopy = new Urlop ($db);
$pracownik->id = $id;
$stmt = $pracownik->pobierz_pracownikow_z_urlopami_brygadzista();




// naglowek strony


echo "<div class='card'>";
    echo "<table class='table  table-dark table-hover table-bordered'>";
    echo "<tr style='text-align:center;'>";
        echo "<th>Imię</th>";
        echo "<th>Nazwisko</th>";
        echo "<th>Stanowisko</th>";
       
        echo "<th>Rodzaj</th>";
        echo "<th>Do kiedy</th>";
        
        echo "</tr>";
   

 


        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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
                    echo "<td><a delete-id='{$id}' class='btn btn-primary delete-object'>
                    <span class='glyphicon glyphicon-remove'></span> O
                    </a></td>";
                    echo "</tr>";
                    echo "</table>";
                    }
                    echo "</td>";
                  }
                    
                   

                    

    
                echo "</table>";
                echo "</div>";
                  

            
                    
                             

                    
                    


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

<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
                    
                    
                            
                    
                    
                       
 
                
               
                   
                   
                   
                      

                
               