<?php
class Material{
 
    // polaczenie do tabeli z bazy
    private $conn;
    private $table_name = "material";
 
    // kolumny zlecenia
    public $id;
    public $material;
    public $kategoria;
    public $cena_jednostkowa;
    
    
    
 
    public function __construct($db){
        $this->conn = $db;
    }

    function dodaj_material_do_zlecenia($id_aktywnego_zlecenia, $ilosc) {
        
        
        $query = "INSERT INTO
        przydzial_materialow
    SET
        id_materialu=:id_materialu, id_zlecenia=:id_zlecenia, ilosc=:ilosc";

$stmt = $this->conn->prepare($query);

// zapisanie wartosci
$this->id=htmlspecialchars(strip_tags($this->id));
$ilosc=htmlspecialchars(strip_tags($ilosc));




// binding zmiennych
$stmt->bindParam(":id_materialu", $this->id);
$stmt->bindParam(":id_zlecenia", $id_aktywnego_zlecenia);
$stmt->bindParam(":ilosc", $ilosc);

if($stmt->execute()){
        return true;
}else{
        return false;
}
        

    }   
    
    
    function pobierz_material_do_zlecenia($id_aktywnego_zlecenia) {

        
            $query = "SELECT material.id, material.material FROM material,przydzial_materialow 
            WHERE material.id = przydzial_materialow.id_materialu 
            AND przydzial_materialow.id_zlecenia = $id_aktywnego_zlecenia ";
    
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            
            return $stmt;
        



    }

    function pobierz_kategorie_materialu_do_zlecenia($id_aktywnego_zlecenia) {

        
        $query = "SELECT material.id, material.kategoria FROM material,przydzial_materialow 
            WHERE material.id = przydzial_materialow.id_materialu 
            AND przydzial_materialow.id_zlecenia = $id_aktywnego_zlecenia ";
    

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt;
    



}


function pobierz_ilosc_materialu_do_zlecenia($id_aktywnego_zlecenia) {

        
    $query = "SELECT id, ilosc FROM przydzial_materialow WHERE id_zlecenia = $id_aktywnego_zlecenia";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    
    return $stmt;
}

function wylistuj_materialy_dla_zlecenia(){
        $query = "SELECT
            id, material, kategoria
        FROM
            " . $this->table_name . "  
           ORDER BY
           kategoria";  

$stmt = $this->conn->prepare( $query );
$stmt->execute();

return $stmt;
   }  


   function pokaz_materialy(){
 
    $query = "SELECT
                id, material, kategoria, cena_jednostkowa
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


    public function pokaz_koszt_dla_zlecenia($id_obecngo_zlecenia) {

        $query = "SELECT przydzial_materialow.ilosc, material.cena_jednostkowa, 
        SUM(przydzial_materialow.ilosc* material.cena_jednostkowa) 
        AS koszt FROM material,przydzial_materialow 
        WHERE material.id = przydzial_materialow.ID_materialu 
        AND przydzial_materialow.id_zlecenia =  $id_obecngo_zlecenia";

$stmt = $this->conn->prepare( $query );
$stmt->execute();

return $stmt;
    }



    function pobierz_material(){
 
        $query = "SELECT
                    id, material, kategoria, cena_jednostkowa
                FROM
                    " . $this->table_name . " WHERE
                    id = ?
                LIMIT
                    0,1";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $this->material = $row['material'];
        $this->kategoria = $row['kategoria'];
        $this->cena_jednostkowa = $row['cena_jednostkowa'];
        
    }


    function edytuj(){
 
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    
                    cena_jednostkowa  = :cena_jednostkowa
                WHERE
                    id = :id";
     
        $stmt = $this->conn->prepare($query);
     

       
        $this->cena_jednostkowa=htmlspecialchars(strip_tags($this->cena_jednostkowa));
        $this->id=htmlspecialchars(strip_tags($this->id));
     
        $stmt->bindParam(':cena_jednostkowa', $this->cena_jednostkowa);
        $stmt->bindParam(':id', $this->id);
     
        // wykonaie zapytania
        if($stmt->execute()){
            return true;
        }
     
        return false;
         
    }
}
?>    