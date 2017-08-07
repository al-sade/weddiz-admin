<?php
require_once(__DIR__.'./../config.php');

class Database
{
    private $host = HOST;
    private $db_name = DB;
    private $username = USER;
    private $password = PASS;
    public $conn;
    public function dbConnection()
	{
    $this->conn = null;
      try{
        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
	    catch(PDOException $exception){
        echo "Connection error: " . $exception->getMessage();
        }
      return $this->conn;
  }
}

