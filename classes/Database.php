
<?php

class Database {

    private $host = 'localhost';
    private $dbName = 'todo_list';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection () {
        $this->conn = null;

        try {
            $this->conn = new PDO ("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOExeption $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        
        return $this->conn;
    }
}