<?php
class Pracownik{
 
    // polaczenie do tabeli z bazy
    private $conn;
    private $table_name = "pracownik";
 
    // kolumny zlecenia
    public $id;
    public $imie;
    public $nazwisko;
    public $rola;
    public $stanowisko;
    public $pensja;
    public $kod;
    public $kontakt;
    public $email;
    public $haslo;
    public $czy_istnieje;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // dodanie zlecenia
    function dodaj(){
 
        //zapytanie
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    imie=:imie, nazwisko=:nazwisko, rola=:rola, stanowisko=:stanowisko, 
                    pensja=:pensja, kod=:kod, kontakt=:kontakt";
 
        $stmt = $this->conn->prepare($query);
 
        // zapisanie wartosci
        $this->imie=htmlspecialchars(strip_tags($this->imie));
        $this->nazwisko=htmlspecialchars(strip_tags($this->nazwisko));
        $this->rola=htmlspecialchars(strip_tags($this->rola));
        $this->stanowisko=htmlspecialchars(strip_tags($this->stanowisko));
        $this->pensja=htmlspecialchars(strip_tags($this->pensja));
        $this->kod=htmlspecialchars(strip_tags($this->kod));
        $this->kontakt=htmlspecialchars(strip_tags($this->kontakt));
 
        // data dodania
        $this->timestamp = date('Y-m-d H:i:s');
 
        // binding zmiennych
        $stmt->bindParam(":imie", $this->imie);
        $stmt->bindParam(":nazwisko", $this->nazwisko);
        $stmt->bindParam(":rola", $this->rola);
        $stmt->bindParam(":stanowisko", $this->stanowisko);
        $stmt->bindParam(":pensja", $this->pensja);
        $stmt->bindParam(":kod", $this->kod);
        $stmt->bindParam(":kontakt", $this->kontakt);
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }

    function pokaz_pracownika(){
 
        $query = "SELECT
                    id, imie, nazwisko, rola, stanowisko,pensja,kod,kontakt
                FROM
                    " . $this->table_name . "
                ORDER BY
                     stanowisko
              ";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    function lista_pracownikow_urlopy(){
 
        $query = "SELECT
                    id, imie, nazwisko,  stanowisko
                FROM
                    " . $this->table_name . "
                ORDER BY
                     ID
                stanowisko
                    ";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    }

    function pobierz_pracownika_do_urlopu(){
 
        $query = "SELECT
                    imie, nazwisko, stanowisko
                FROM
                    " . $this->table_name . "
                WHERE
                    id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->imie = $row['imie'];
        $this->nazwisko = $row['nazwisko'];
        $this->stanowisko = $row['stanowisko'];
        
    }

    function pobierz_pracownikow_do_zlecenia($id_wybranego_zlecenia){
        $query = "SELECT
          id, imie, nazwisko, stanowisko,kontakt 
        FROM ". $this->table_name ." 
        WHERE id IN (SELECT id_pracownika FROM przydzial_pracownikow 
        WHERE id_zlecenia = $id_wybranego_zlecenia) ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    





        public function policz(){
 
        $query = "SELECT ID FROM " . $this->table_name . "";
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        $num = $stmt->rowCount();
 
        return $num;
        }

        function pobierz_pracownika(){
 
            $query = "SELECT
                        imie, nazwisko, rola, stanowisko, pensja, kod,kontakt
                    FROM
                        " . $this->table_name . "
                    WHERE
                        id = ?
                    LIMIT
                        0,1";
         
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
         
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
         
            $this->imie = $row['imie'];
            $this->nazwisko = $row['nazwisko'];
            $this->rola = $row['rola'];
            $this->stanowisko = $row['stanowisko'];
            $this->pensja = $row['pensja'];
            $this->kod = $row['kod'];
            $this->kontakt = $row['kontakt'];
        }


        function edytuj(){
 
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        imie = :imie,
                        nazwisko = :nazwisko,
                        rola = :rola,
                        stanowisko  = :stanowisko,
                        pensja  = :pensja,
                        kod  = :kod,
                        kontakt  = :kontakt
                    WHERE
                        id = :id";
         
            $stmt = $this->conn->prepare($query);
         
           
            $this->imie=htmlspecialchars(strip_tags($this->imie));
            $this->nazwisko=htmlspecialchars(strip_tags($this->nazwisko));
            $this->rola=htmlspecialchars(strip_tags($this->rola));
            $this->stanowisko=htmlspecialchars(strip_tags($this->stanowisko));
            $this->pensja=htmlspecialchars(strip_tags($this->pensja));
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->kod=htmlspecialchars(strip_tags($this->kod));
            $this->kontakt=htmlspecialchars(strip_tags($this->kontakt));
            
         
            
            $stmt->bindParam(':imie', $this->imie);
            $stmt->bindParam(':nazwisko', $this->nazwisko);
            $stmt->bindParam(':rola', $this->rola);
            $stmt->bindParam(':stanowisko', $this->stanowisko);
            $stmt->bindParam(':pensja', $this->pensja);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':kod', $this->kod);
            $stmt->bindParam(':kontakt', $this->kontakt);
         
            // wykonaie zapytania
            if($stmt->execute()){
                return true;
            }
         
            return false;
             
        }


        
        function usun(){
 
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
 
        if($result = $stmt->execute()){
            
            return true;
    }   else{
        return false;
    }
            }



            function wylistuj_pracownikow_dla_zlecenia($id_aktywnego_zlecenia){
                $query = "SELECT
                    id, imie, nazwisko, stanowisko, rola
                FROM
                    " . $this->table_name . " WHERE
                     id NOT IN (SELECT id_pracownika FROM urlop) AND
                     id NOT IN (SELECT id_pracownika FROM przydzial_pracownikow 
                     WHERE id_zlecenia=$id_aktywnego_zlecenia) AND
                     
                     rola <> 'kierownik' 
                     
                     


                ORDER BY
                    stanowisko";  
 
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
 
        return $stmt;
            }


            function dodaj_pracownika_do_zlecenia($id_aktywnego_zlecenia) {

                $query = "INSERT INTO
                przydzial_pracownikow
            SET
                id_pracownika=:id_pracownika, id_zlecenia=:id_zlecenia";

    $stmt = $this->conn->prepare($query);

    // zapisanie wartosci
    $this->id=htmlspecialchars(strip_tags($this->id));
    

    // binding zmiennych
    $stmt->bindParam(":id_pracownika", $this->id);
    $stmt->bindParam(":id_zlecenia", $id_aktywnego_zlecenia);
    

    if($stmt->execute()){
        return true;
    }else{
        return false;
    }
                

            }

            function usun_pracownika_z_przydzialu($id_aktywnego_zlecenia){
 
                $query = "DELETE FROM przydzial_pracownikow WHERE id_pracownika = ? AND 
                id_zlecenia =$id_aktywnego_zlecenia ";
             
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(1, $this->id);
         
                if($result = $stmt->execute()){
                    
                    return true;
            }   else{
                return false;
            }
                    }


                    
function czyIstniejeEmail(){
 
   
    $query = "SELECT id, imie, nazwisko, rola, stanowisko, email, haslo, czy_istnieje 
            FROM " . $this->table_name . "
            WHERE email = ?
            LIMIT 0,1";
 
 
    $stmt = $this->conn->prepare( $query );
 
   
    $this->email=htmlspecialchars(strip_tags($this->email));
 

    $stmt->bindParam(1, $this->email);
 
    
    $stmt->execute();
 
    
    $num = $stmt->rowCount();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($num>0 && $row['email']!=null){
 
      
        
 
        
        $this->id = $row['id'];
        $this->imie = $row['imie'];
        $this->nazwisko = $row['nazwisko'];
        $this->rola = $row['rola'];
        $this->stanowisko = $row['stanowisko'];
        $this->haslo = $row['haslo'];
        $this->czy_istnieje = $row['czy_istnieje'];
 
        
        return true;
    }
 
    
    return false;
}



function czykod(){
 
   
    $query = "SELECT id, imie, nazwisko, rola, kod, stanowisko, haslo, czy_istnieje 
            FROM " . $this->table_name . "
            WHERE kod = ?
            LIMIT 0,1";
 
 
    $stmt = $this->conn->prepare( $query );
 
   
    $this->kod= intval($this->kod);
 

    $stmt->bindParam(1, $this->kod);
 
    
    $stmt->execute();
 
    
    $num = $stmt->rowCount();
 
    
    if($num>0){
 
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        
        $this->id = $row['id'];
        $this->imie = $row['imie'];
        $this->imie = $row['kod'];
        $this->nazwisko = $row['nazwisko'];
        $this->rola = $row['rola'];
        $this->stanowisko = $row['stanowisko'];
        $this->haslo = $row['haslo'];
        $this->czy_istnieje = $row['czy_istnieje'];
 
        
        return true;
    }
 
    return false;
}



function czystworzony(){
 
 $query = "SELECT id, imie, nazwisko, rola,kod, stanowisko, haslo, czy_istnieje 
            FROM " . $this->table_name . "
            WHERE kod = ?
            LIMIT 0,1";
 
 
    $stmt = $this->conn->prepare( $query );
 
   
    $this->kod=htmlspecialchars(strip_tags($this->kod));
 

    $stmt->bindParam(1, $this->kod);
 
    
    $stmt->execute();
 
    
    $num = $stmt->rowCount();
    
    if($num>0){
 
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        
        $this->id = $row['id'];
        $this->imie = $row['imie'];
        $this->imie = $row['kod'];
        $this->nazwisko = $row['nazwisko'];
        $this->rola = $row['rola'];
        $this->stanowisko = $row['stanowisko'];
        $this->haslo = $row['haslo'];
        $this->czy_istnieje = $row['czy_istnieje'];

        if ($this->czy_istnieje != 1) {
 
        return true;
        }
        else { return false;}
    }
        return false;
}

function zarejestruj(){
 
    $query = "UPDATE
    " . $this->table_name . "
SET
    email = :email,
    haslo = :haslo,
    czy_istnieje = 1
    
WHERE
    kod = :kod";

$stmt = $this->conn->prepare($query);


$this->email=htmlspecialchars(strip_tags($this->email));
$this->haslo=htmlspecialchars(strip_tags($this->haslo));
$this->kod=htmlspecialchars(strip_tags($this->kod));




$stmt->bindParam(':email', $this->email);
$password_hash = password_hash($this->haslo, PASSWORD_DEFAULT);
$stmt->bindParam(':haslo', $password_hash);
$stmt->bindParam(':kod', $this->kod);


// wykonaie zapytania
if($stmt->execute()){
return true;
}

return false;
}



function reset_hasla(){
 
    $query = "UPDATE
    " . $this->table_name . "
SET
    
    haslo = :haslo
    
    
WHERE
    email = :email";

$stmt = $this->conn->prepare($query);


$this->email=htmlspecialchars(strip_tags($this->email));
$this->haslo=htmlspecialchars(strip_tags($this->haslo));





$stmt->bindParam(':email', $this->email);
$password_hash = password_hash($this->haslo, PASSWORD_DEFAULT);
$stmt->bindParam(':haslo', $password_hash);



// wykonaie zapytania
if($stmt->execute()){
return true;
}

return false;
}


function czykod_weryfikacja(){
 
   
    $query = "SELECT id, imie, nazwisko, rola, kod, stanowisko, haslo, czy_istnieje 
            FROM " . $this->table_name . "
            WHERE kod =:kod AND email =:email
            LIMIT 0,1";
 
 
    $stmt = $this->conn->prepare( $query );
 
   $this->kod= intval($this->kod);
 

    $stmt->bindParam(':kod', $this->kod);
    $stmt->bindParam(':email', $this->email);
 
    
    $stmt->execute();
 
    
    $num = $stmt->rowCount();
 
    
    if($num>0){
 
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        
        $this->id = $row['id'];
        $this->imie = $row['imie'];
        $this->imie = $row['kod'];
        $this->nazwisko = $row['nazwisko'];
        $this->rola = $row['rola'];
        $this->stanowisko = $row['stanowisko'];
        $this->haslo = $row['haslo'];
        $this->czy_istnieje = $row['czy_istnieje'];
        $this->email = $row['email'];
 
        
        return true;
    }
     return false;
}


function pobierz_brygadziste(){
 
   
    $query = "SELECT  id,imie, nazwisko, stanowisko, pensja 
            FROM " . $this->table_name . "
            WHERE id = ?
            ";
 
 
    $stmt = $this->conn->prepare( $query );
 
   
  
 

    $stmt->bindParam(1, $this->id);
 
 
    
    $stmt->execute();
 
    
    $num = $stmt->rowCount();
 
    
    if($num>0){
 
      
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
        
        
        $this->id = $row['id'];
        $this->imie = $row['imie'];
     
        $this->nazwisko = $row['nazwisko'];
      
        $this->stanowisko = $row['stanowisko'];
        $this->pensja = $row['pensja'];
      
 
        
        return true;
    }
        return false;
}



function pokaz_zlecenie_dla_brygadzisty(){
 
    $query = "SELECT
                 zlecenie.id, adres, typ_prac, metraz
            FROM
                zlecenie, przydzial_pracownikow
            WHERE zlecenie.id = przydzial_pracownikow.id_zlecenia AND 
            przydzial_pracownikow.id_pracownika = ? 
            ";
 

            
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->id);
    
            
            $stmt->execute();
 
    return $stmt;
}





function pokaz_zlecenie_dla_pracownika(){
 
    $query = "SELECT zlecenie.id, adres, typ_prac, metraz FROM zlecenie, przydzial_pracownikow 
    WHERE zlecenie.id = przydzial_pracownikow.id_zlecenia 
    AND przydzial_pracownikow.id_pracownika = ?
            ";
 

            
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->id);
    
            
            $stmt->execute();
 
    return $stmt;
}



function pokaz_brygadziste_dla_pracownika($id_zlecenia){
 
    $query = "SELECT
                  imie, nazwisko, stanowisko, kontakt
            FROM
                przydzial_pracownikow, pracownik
            WHERE  przydzial_pracownikow.id_zlecenia = $id_zlecenia AND 
            pracownik.rola = 'brygadzista' AND pracownik.id= przydzial_pracownikow.id_pracownika
            ";
            
            $stmt = $this->conn->prepare( $query );
            $stmt->bindParam(1, $this->id);
    
            
            $stmt->execute();
 
    return $stmt;
}
function pobierz_pracownikow_z_urlopami_brygadzista(){
 
   
    $query = "SELECT  pracownik.id,pracownik.imie, pracownik.nazwisko, pracownik.stanowisko, 
    pracownik.pensja 
            FROM " . $this->table_name . ",przydzial_pracownikow
            WHERE pracownik.id = przydzial_pracownikow.id_pracownika AND
            przydzial_pracownikow.id_zlecenia =  (SELECT id_zlecenia FROM przydzial_pracownikow WHERE
            id_pracownika = ?)
            ";
 
 
    $stmt = $this->conn->prepare( $query );
 
   
  
 

    $stmt->bindParam(1, $this->id);
 
 
    
    $stmt->execute();
 
    return $stmt;
}
}
?>