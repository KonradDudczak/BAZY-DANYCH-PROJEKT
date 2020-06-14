<?php

$mail = $_GET['id'];
session_start();
 
$access_denied = false;


include_once "logowanie_naglowek.php";


if($_POST) {

include_once "baza_danych.php";
include_once "klasa_pracownicy.php";




$database = new Database();
$db = $database->getConnection();
 

$pracownik = new Pracownik($db);

$pracownik->email = $mail;







 if($_POST['haslo1'] == $_POST['haslo2'])  {

    $pracownik->haslo = $_POST['haslo1'];

        if($pracownik->reset_hasla()){
            echo "<div class='alert alert-success margin-top-40' role='alert'>
       
                <p>Hasło zostało zmienione!</p>
           </div>";

        } else {echo "<div class='alert alert-danger margin-top-40' role='alert'>
       
            <p>Nie można zmienić hasła!</p>
        </div>";}



 } else {echo "<div class='alert alert-danger margin-top-40' role='alert'>
       
        <p>Hasła nie są takie same</p>
    </div>";}

}   
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
                    <form class='form-signin' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]). "?id={$mail}"?>" method='post'>

                    

                    <div class="form-textbox">
                        <label for="email"></label>
                        <input type="password" name="haslo1" id="email" placeholder="Wprowadz haslo" />
                    </div>

                    <div class="form-textbox">
                        <label for="email"></label>
                        <input type="password" name=haslo2 id="email" placeholder="Potwierdz haslo" />
                    </div>

                   

                   

                    <div class="form-textbox">
                        <input type="submit" name="submit" id="submit" class="submit" value="Resetuj hasło" />
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