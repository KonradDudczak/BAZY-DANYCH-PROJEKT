<?php
class Urlop{
 
    // polaczenie do tabeli z bazy
    private $conn;
    private $table_name = "urlop";
 
    // kolumny zlecenia
    public $id;
    public $id_pracownika;
    public $opis;
    public $do_kiedy;
    
 
    public function __construct($db){
        $this->conn = $db;
    }

    function dodaj(){
 
        //zapytanie
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    opis=:opis, id_pracownika=:id_pracownika, do_kiedy=:do_kiedy";
 
        $stmt = $this->conn->prepare($query);
 
        // zapisanie wartosci
        $this->opis=htmlspecialchars(strip_tags($this->opis));
        $this->id_pracownika=htmlspecialchars(strip_tags($this->id_pracownika));
        $this->do_kiedy=htmlspecialchars(strip_tags($this->do_kiedy));
      
 
        // data dodania
        $this->timestamp = date('Y-m-d ');
 
        // binding zmiennych
        $stmt->bindParam(":opis", $this->opis);
        $stmt->bindParam(":id_pracownika", $this->id_pracownika);
        $stmt->bindParam(":do_kiedy", $this->do_kiedy);
        
 
        if($stmt->execute()){
            return true;
           
        }else{
            return false;
            
        }
    }
    

        function pobierz_urlopy($id_wybranego_pracownika){
            $query = "SELECT
              id, opis, do_kiedy 
            FROM ". $this->table_name ." 
            WHERE id_pracownika = $id_wybranego_pracownika ";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
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


            





        
 
    








}
?>