<?php 
require_once("config.php");

class DataBase {

    public $connect;

    public function __construct(){
        $this->connection();
    }
    
    public function connection(){
        $this->connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if($this->connect->connect_errno){
            die("DB connection failed. " . $this->connect->connect_error);
        }
    }

    public function query($sql){
        $res = $this->connect->query($sql);
        $this->confirm_query($res);
        return $res;
    }

    private function confirm_query($result){
        if(!$result) {
            die('Query failed.' . $this->connect->error);
        }
    }

    public function escape_string($string){
        $escapeStr = $this->connect->real_escape_string($string);
        return $escapeStr;
    }

    public function insertID(){
        return mysqli_insert_id($this->connect);
    }
    
}

$db = new DataBase();

?>