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

 

$czy_email_istnieje = $pracownik->czyIstniejeEmail();



if ($czy_email_istnieje and (password_verify($_POST['haslo'], $pracownik->haslo))){
 
    session_start();
 
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $pracownik->id;
    $_SESSION['access_level'] = $pracownik->rola;
    $_SESSION['firstname'] = htmlspecialchars($pracownik->imie, ENT_QUOTES, 'UTF-8') ;
    $_SESSION['lastname'] = $pracownik->nazwisko;
 
 
    if($pracownik->rola=="kierownik"){
        header("Location: ./zlecenia.php");
    }
 

    elseif ($pracownik->rola=="brygadzista")
    {
        header("Location: ./dashboard_brygadzista.php?id={$_SESSION['user_id']}");
    }

    elseif ($pracownik->rola=="pracownik")
    {
        header("Location: ./dashboard_pracownik.php?id={$pracownik->id}");
    }
}

else{
  
        echo "<div class='alert alert-danger margin-top-40' role='alert'>
           
            <h1></h1>Login lub hasło niepoprawne. Masz konto?</h1>
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
  <title>Formularz logowania</title>
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 login-section-wrapper">
          <div class="brand-wrapper">
              <div class="badge badge-warning text-wrap" style="width: 20rem; height: 8rem;">
                  <h1>Witaj w panelu logowania!</h1>
              </div>
          </div>
          
          <div class="login-wrapper my-auto">
            <h1 class="login-title">Zaloguj się</h1>
            <form class='form-signin' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method='post'>";
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="email@przykład.com">
              </div>
              <div class="form-group mb-4">
                <label for="password">Hasło</label>
                <input type="password" name="haslo" id="haslo" class="form-control" placeholder="Wprowadź swoje hasło">
              </div>
              <input name="action" id="login" class="btn btn-block login-btn" type="submit" value="Zaloguj">
            
            <a href="./przypomnieniehasla.php" class="forgot-password-link">Zapomniałeś hasła?</a>
            <p class="login-wrapper-footer-text">Nie masz konta? <a href="./rejestracja.php" class="text-reset">Rejestracja</a></p>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="budowa.jpg" alt="login image" class="login-img">
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
