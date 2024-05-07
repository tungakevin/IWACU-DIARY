<?php
class My_connection{
    private $server ="mysql:host=localhost;dbname=iwacu";
    private $username="root";
    private $password="";
    private $option= array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,);
    protected $conn;
    public function open(){
        try {
            $this ->conn = new PDO($this->server,$this->username,$this->password,$this->option);
            return $this->conn;
            echo "Connected Successfully";
        } catch (PDOException $e) {
       echo "fail to connect to databasee ".$e->getMessage();
        }
    }
 public function close(){
    $this->conn = null;
 }
}
?>