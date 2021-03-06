<?php

$id = $_GET['id'];
 

 


include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';
include_once 'klasa_zlecenia.php';


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
$page_title = "Przydział pracowników";
include_once "layout_naglowek.php";


 
// instantiate database and objects
$database = new Database();
$db = $database->getConnection();
$pracownik  = new Pracownik ($db);
$pracownik->id = $id;
$stmt = $pracownik->pokaz_zlecenie_dla_brygadzisty();
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
            echo "<th>Kontakt</th>";
            
            
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
                        echo "<td><a class='btn btn-primary '>
                        <span class='glyphicon glyphicon-remove'></span> R
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";
                        }
                        echo "</td>";
                        

                        
                    echo"<td>";
                    
                    $stmt3 = $pracownik->pobierz_pracownikow_do_zlecenia($id_wybranego_zlecenia);
                    while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)){
                        extract($row3);
                        echo"<table class='table table-dark table-hover table-bordered'>";
                        echo "<tr>";
                        echo "<td>{$kontakt}</td>";
                        echo "<td><a class='btn btn-warning '>
                        <span class='glyphicon glyphicon-remove'></span> K
                        </a></td>";
                        echo "</tr>";
                        echo "</table>";
                        }
                        echo "</td>";
                       


                    } 
                    echo "</table>";
                    echo "</div>" ; 
                    
                    
                    
                             

                    
                    


    // the page where this paging is used

 
// count all products in the database to calculate total pages

 
// paging buttons here

                
                }

                else{
                    echo "<div class='alert alert-info'>Nie masz przydzielonych zleceń.</div>";
                }

 
// tell the user there are no products

// stopka
include_once "layout_stopka.php";
?>
<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
                    
                    
                            
                    
                    
                       
 
                
               
                   
                   
                   
                      

                
               