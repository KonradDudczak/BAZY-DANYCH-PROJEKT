
<?php $id3 = $_GET['id'];
$id2 = $_GET['id2']; ?>
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
          <?php echo "<a href='./dashboard_brygadzista.php?id={$id3}'>Dane personalne</a>";?>
        </li>
        <li>
        <?php echo "<a href='./pracownicy_brygadzisty.php?id={$id3}'>Pracownicy dla twoich zleceń</a>";?>
        </li>
        <li>
        <?php echo "<a href='./przydzial_materialow_brygadzista.php?id={$id3}'>Przydział materiałów</a>";?>
        </li>
        <li>
        <?php echo "<a href='./urlop_brygadzista.php?id={$id3}'>Przydział materiałów</a>";?>
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




$page_title = "Dodaj materiał do zlecenia";
include_once "layout_naglowek.php";


include_once 'baza_danych.php';
include_once 'klasa_materialy.php';
include_once 'klasa_zlecenia.php';
$database = new Database();
$db = $database->getConnection();





$material = new Material($db);
$zlecenie = new Zlecenie($db);

$zlecenie->id=$id2;



$zlecenie->pobierz_zlecenie_do_przydzialu();

if($_POST){
    $material->id = $_POST['material']; 
    $ilosc = $_POST['ilosc'];
   
    
    
  
 
 
    if($material->dodaj_material_do_zlecenia($zlecenie->id, $ilosc)){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Dodano materiały";
        echo "</div>";
    }
 

    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Nie można dodać materiałów!";
        echo "</div>";
    }
}
?>
<?php
echo "<div class='right-button-margin'>";
    echo "<a href='przydzial_materialow_brygadzista.php?id={$id3}' class='btn btn-warning pull-right'>Zobacz Przydziały</a>";
echo "</div>";
?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id2={$id2}&id={$id3}");?>" method="post">
<div class="card">
    <table class='table table-dark table-hover table-bordered'>
 
        <tr>
            <td>Adres</td>
            <td><input type='text' name='adres' value='<?php echo $zlecenie->adres; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td>Typ prac</td>
            <td><input type='text' name='typ_prac' value='<?php echo $zlecenie->typ_prac; ?>' class='form-control' readonly /></td>
        </tr>
 
        <tr>
            <td>Metraż (m<sup>2</sup>)</td>
            <td><input type="text" name='metraz' value='<?php echo $zlecenie->metraz; ?>' class='form-control' readonly></input></td>
        </tr>
 
        <tr>
            <td>Materiał</td>
            <td><?php

$stmt = $material->wylistuj_materialy_dla_zlecenia($zlecenie->id);
 

echo "<select class='form-control' name='material'>";
    echo "<option>Wybierz material</option>";
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        echo "<option value='{$id}'>{$material} : {$kategoria}</option>";
    }
 
echo "</select>";
?></td>
            
        </tr>

        <tr>
            <td>Ilość</td>
            <td><input type="text" name='ilosc'  class='form-control' ></input></td>
        </tr>


        
 
        <tr>
            <td></td>
            <td>
            <button  type="submit" class="btn btn-primary">Dodaj</button>
            </td>
        </tr>
 
    </table>
    </div>

    
<script> 
$("table").fadeOut().delay(500).fadeIn();


  </script>
</form>

<?php include_once 'layout_stopka.php'; ?>