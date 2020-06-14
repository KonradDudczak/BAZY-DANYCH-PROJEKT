<?php
class Database{
  
    // atrybuty polaczenia
    private $host = "localhost";
    private $db_name = "firma";
    private $username = "root";
    private $password = "";
    public $conn;
  
    // polaczenie z baza 
    public function getConnection(){
  
        $this->conn = null;
  
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . 
            $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Błąd łączenia: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>