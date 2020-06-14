<?php


session_start();
 
$access_denied = false;


include_once "logowanie_naglowek.php";

if($_POST) {

include_once "baza_danych.php";
include_once "klasa_pracownicy.php";


 

$database = new Database();
$db = $database->getConnection();
 

$pracownik = new Pracownik($db);

 
$pracownik->email=$_POST['email'];
$pracownik->kod=$_POST['kod'];



 

$czy_email_istnieje = $pracownik->czyIstniejeEmail();
$czy_kod = $pracownik->czykod_weryfikacja();
 


if ($czy_email_istnieje) {

    
    if ($czy_kod){

        header("Location: ./reset_hasla.php?id={$pracownik->email}");




    } else{
  
        echo "<div class='alert alert-danger margin-top-40' role='alert'>
           
            <p>Nieprawidłowy kod.</p>
        </div>";
    }




} 
else{
  
    echo "<div class='alert alert-danger margin-top-40' role='alert'>
       
        <p>Jesteś zarejestrowany? Brak takiego maila.</p>
    </div>";
}
}
include_once "logowanie_stopka.php";    
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Odzyskaj hasło</title>


    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">


    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: white;">

    <div class="main">

        <h1></h1>
        <div class="container">
            <div class="sign-up-content">
                
                    </div>
                    <form class='form-signin' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method='post'>

                    

                    <div class="form-textbox">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="" />
                    </div>

                    <div class="form-textbox">
                        <label for="email">Kod</label>
                        <input type="text" name="kod" id="email" placeholder="" />
                    </div>

                   

                   

                    <div class="form-textbox">
                        <input type="submit" name="submit" id="submit" class="submit" value="Sprawdź" />
                    </div>
                </form>

                <p class="loginhere">
                <a href="./logowanie.php" class="loginhere-link"> Logowanie</a>
                </p>
            </div>
        </div>

    </div>

    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>