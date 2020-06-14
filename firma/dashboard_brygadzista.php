<?php


$id = $_GET['id'];
 

include_once 'baza_danych.php';
include_once 'klasa_pracownicy.php';

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

$database = new Database();
$db = $database->getConnection();
 
$pracownik = new pracownik($db);
$pracownik->id = $id;
 

$pracownik->pobierz_brygadziste();





$page_title = "Twoje dane";
include_once "layout_naglowek.php";







?>

<?php


$page_url = "zlecenia.php?";
 


?>
<div class="card">
<table class="table table-hover table-dark table-resposive table-bordered" style = "text-align: center;">
 
        <tr>
            <td><strong>Imię</strong></td>
            <td><?php echo $pracownik->imie;?></td>
        </tr>
 
        <tr>
            <td><strong>Nazwisko</strong></td>
            <td><?php echo $pracownik->nazwisko;?></td>
        </tr>

        <tr>
            <td><strong>Stanowisko</strong></td>
            <td><?php echo $pracownik->stanowisko;?> </td>
        </tr>

        <tr>
            <td><strong>Pensja</strong></td>
            <td><?php echo $pracownik->pensja;?> zł</td>
        </tr>

</table>
</div>


<div class="opis" style=" position: relative; left: 10px; top: 85px;">

<h1>Twoje zlecenia</h1>

</div>

<?php

echo "<div class='card' style=' posiotion: relative; top: 85px; text-align: center;'>";
    echo "<table class='table table-dark table-hover  table-bordered'>";
        echo "<tr>";
            echo "<th>Adres</th>";
            echo "<th>Typ prac</th>";
            echo "<th>Metraz (m<sup>2</sup>)</th>";
           
        echo "</tr>";
       
        $stmt =  $pracownik->pokaz_zlecenie_dla_brygadzisty();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$adres}</td>";
                echo "<td>{$typ_prac}</td>";
                echo "<td>{$metraz}</td>";
            echo "</tr>";
        }
            
    echo "</table>";

    echo "</div>";
    
    include_once "layout_stopka.php";
                
                
                   
               
 
 
            
 
        
        

  ?>  
  
  <script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
 
