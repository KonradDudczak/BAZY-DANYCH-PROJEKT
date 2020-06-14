<?php
class Statystyki{
 
    // polaczenie do tabeli z bazy
    private $conn;
    
    
    public function __construct($db){
        $this->conn = $db;
    }

    function pokaz_zlecenie_do_statystyk(){
 
        $query = "SELECT
                    id, adres, typ_prac, metraz, ustalona_cena
                FROM
                    zlecenie
                ORDER BY
                     ID
                
                    ";
     
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
     
        return $stmt;
    
}

    public function pobierz_koszt_zlecenia($id_obecngo_zlecenia) {

        $query = "SELECT przydzial_materialow.ilosc, material.cena_jednostkowa, 
        SUM(przydzial_materialow.ilosc* material.cena_jednostkowa) 
        AS koszt FROM material,przydzial_materialow 
        WHERE material.id = przydzial_materialow.ID_materialu 
        AND przydzial_materialow.id_zlecenia =  $id_obecngo_zlecenia";

$stmt = $this->conn->prepare( $query );
$stmt->execute();

return $stmt;
    }

    public function pobierz_liczbe_pracownikow($id_obecngo_zlecenia) {

        $query = "SELECT COUNT(id_pracownika) AS liczba FROM 
        przydzial_pracownikow WHERE id_zlecenia =  $id_obecngo_zlecenia";

    $stmt = $this->conn->prepare( $query );
    $stmt->execute();

    return $stmt;
    }

    function pobierz_liczbe_zlecen(){
 
        $query = "SELECT
                        COUNT(id) AS zlecenia FROM zlecenie";
     
        $stmt = $this->conn->prepare( $query );
        
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $liczba_zlecen = $row['zlecenia'];

        return $liczba_zlecen;
        
    }

    function pobierz_wszystkich_pracownikow(){
 
        $query = "SELECT
                        COUNT(id) AS pracownicy FROM pracownik";
     
        $stmt = $this->conn->prepare( $query );
        
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $liczba_pracownikow = $row['pracownicy'] -1;

        return $liczba_pracownikow;
        
    }

    function pobierz_koszty_materialowe(){
 
        $query = "SELECT przydzial_materialow.ilosc, material.cena_jednostkowa, 
        SUM(przydzial_materialow.ilosc* material.cena_jednostkowa) AS calkowite 
        FROM material,przydzial_materialow 
        WHERE material.id = przydzial_materialow.ID_materialu 
        ";
     
        $stmt = $this->conn->prepare( $query );
        
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $koszty_materialowe = $row['calkowite'];

        return $koszty_materialowe;
        
    }

    function pobierz_przewidywany_przychod(){

       
 
        $query = "SELECT przydzial_materialow.ilosc, material.cena_jednostkowa, 
        SUM(przydzial_materialow.ilosc* material.cena_jednostkowa) AS calkowite 
        FROM material,przydzial_materialow 
        WHERE material.id = przydzial_materialow.ID_materialu 
        ";
     
        $stmt = $this->conn->prepare( $query );
        
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $koszty_materialowe = $row['calkowite'];

        $query2 = "SELECT SUM(ustalona_cena) AS dochod FROM zlecenie;
        ";
     
        $stmt2 = $this->conn->prepare( $query2 );
        
        $stmt2->execute();
     
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
     
        $dochod = $row2['dochod'];

        $przychod = $dochod - $koszty_materialowe;

        

        return $przychod;
        
    }

    function pobierz_kwote_wyplat(){
 
        $query = "SELECT SUM(pensja) AS wyplaty FROM pracownik
        ";
     
        $stmt = $this->conn->prepare( $query );
        
        $stmt->execute();
     
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        $wyplaty = $row['wyplaty'];

        return $wyplaty;
        
    }
}
?>


