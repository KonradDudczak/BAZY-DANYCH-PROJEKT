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

$pracownik->haslo=$_POST['haslo'];


$czy_email_istnieje = $pracownik->czyIstniejeEmail();
$czy_kod = $pracownik->czykod();
 


if ($czy_kod) {

    if($pracownik->czystworzony()) {

        if ($czy_email_istnieje){

            echo "<div class='alert alert-danger'>";
            echo "Ten Email jest zajęty.</a>";
            echo "</div>";}

            else {






if($pracownik->zarejestruj()){






 
    echo "<div class='alert alert-info'>";
        echo "Zarejestrowano";
    echo "</div>";
 

    
 
}






else{
    echo "<div class='alert alert-danger' role='alert'>Niestety nie można zarejestrować.</div>";
}
            }


    } 
    
    
    
    
    
    else {{echo "<div class='alert alert-danger margin-top-40' role='alert'>
           
        </h1>Jestes juz zarejestrowany.</h1>
    </div>";}
    }

} 
 
else {{echo "<div class='alert alert-danger margin-top-40' role='alert'>
           
    </h1>Nie ma takiego pracownika w bazie.</h1>
</div>";}
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
    <title>Utwórz konto</title>


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
                        <label for="kod">Kod</label>
                        <input type="text" name="kod" id="kod" />
                    </div>

                    <div class="form-textbox">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" />
                    </div>

                    <div class="form-textbox">
                        <label for="haslo">Hasło</label>
                        <input type="password" name="haslo" id="haslo" />
                    </div>

                   

                    <div class="form-textbox">
                    <div  type="button" class="btn btn-primary">
                        <input type="submit" name="submit" id="submit" class="submit" value="Utwórz konto" />
                    </div>
                    </div>
                </form>

                <p class="loginhere">
                    Masz juz konto?<a href="./logowanie.php" class="loginhere-link"> Logowanie</a>
                </p>
            </div>
        </div>

    </div>

    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>