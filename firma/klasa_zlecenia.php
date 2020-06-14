<?php
class Zlecenie{
 
    // polaczenie do tabeli z bazy
    private $conn;
    private $table_name = "zlecenie";
 
    // kolumny zlecenia
    public $id;
    public $adres;
    public $typ_prac;
    public $metraz;
    public $ustalona_cena;
    public $timestamp;
 
    public function __construct($db){
        $this->conn = $db;
    }
 
    // dodanie zlecenia
    function dodaj(){
 
        //zapytanie
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    adres=:adres, typ_prac=:typ_prac, metraz=:metraz, ustalona_cena=:ustalona_cena";
 
        $stmt = $this->conn->prepare($query);
 
        // zapisanie wartosci
        $this->adres=htmlspecialchars(strip_tags($this->adres));
        $this->typ_prac=htmlspecialchars(strip_tags($this->typ_prac));
        $this->metraz=htmlspecialchars(strip_tags($this->metraz));
        $this->ustalona_cena=htmlspecialchars(strip_tags($this->ustalona_cena));
 
        // data dodania
        $this->timestamp = date('Y-m-d H:i:s');
 
        // binding zmiennych
        $stmt->bindParam(":adres", $this->adres);
        $stmt->bindParam(":typ_prac", $this->typ_prac);
        $stmt->bindParam(":metraz", $this->metraz);
        $stmt->bindParam(":ustalona_cena", $this->ustalona_cena);
       
 
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
 
    }

    function pokaz_zlecenie(){
 
        $query = "SELECT
                    id, adres, typ_prac, metraz, ustalona_cena
                FROM
                    " . $this->table_name . "
                ORDER BY
                     ID
               ";
     
        $stmt = $this->conn->prepare( $query );
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

        function pobierz_zlecenie(){
 
            $query = "SELECT
                        adres, typ_prac, metraz, ustalona_cena
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
         
            $this->adres = $row['adres'];
            $this->typ_prac = $row['typ_prac'];
            $this->metraz = $row['metraz'];
            $this->ustalona_cena = $row['ustalona_cena'];
        }


        function edytuj(){
 
            $query = "UPDATE
                        " . $this->table_name . "
                    SET
                        adres = :adres,
                        typ_prac = :typ_prac,
                        metraz = :metraz,
                        ustalona_cena  = :ustalona_cena
                    WHERE
                        id = :id";
         
            $stmt = $this->conn->prepare($query);
         

            $this->adres=htmlspecialchars(strip_tags($this->adres));
            $this->typ_prac=htmlspecialchars(strip_tags($this->typ_prac));
            $this->metraz=htmlspecialchars(strip_tags($this->metraz));
            $this->ustalona_cena=htmlspecialchars(strip_tags($this->ustalona_cena));
            $this->id=htmlspecialchars(strip_tags($this->id));
         
            
            $stmt->bindParam(':adres', $this->adres);
            $stmt->bindParam(':typ_prac', $this->typ_prac);
            $stmt->bindParam(':metraz', $this->metraz);
            $stmt->bindParam(':ustalona_cena', $this->ustalona_cena);
            $stmt->bindParam(':id', $this->id);
         
            // wykonaie zapytania
            if($stmt->execute()){
                return true;
            }
         
            return false;
             
        }


        // usuwanie zlecenia
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


            function lista_zlecen_przydzial_pracownikow(){
 
                $query = "SELECT
                            id, adres, typ_prac, metraz
                        FROM
                            " . $this->table_name . "
                        ORDER BY
                             ID
                        
                            ";
             
                $stmt = $this->conn->prepare( $query );
                $stmt->execute();
             
                return $stmt;
            }

            function pobierz_zlecenie_do_przydzialu(){
 
                $query = "SELECT
                            adres, typ_prac, metraz
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
             
                $this->adres = $row['adres'];
                $this->typ_prac = $row['typ_prac'];
                $this->metraz = $row['metraz'];
                
            }


             function lista_zlecen_przydzial_materialow() {

                $query = "SELECT
                            id, adres, typ_prac, metraz
                        FROM
                            " . $this->table_name . "
                        ORDER BY
                             ID
                        ";
             
                $stmt = $this->conn->prepare( $query );
                $stmt->execute();
             
                return $stmt;




             }


             function usun_material_z_przydzialu($id_przydzialu){
 
             $query = "DELETE FROM przydzial_materialow WHERE id = {$id_przydzialu}"; 
             
                $stmt = $this->conn->prepare($query);
                
         
                if($stmt->execute()){
                    
                    return true;
            }   else{
                return false;
            }
                    }




}

?>

