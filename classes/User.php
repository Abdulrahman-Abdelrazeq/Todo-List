<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create ($name, $age, $address) {
        // Ensure string variables are enclosed in single quotes
        $name = $this->conn->quote($name);
        $address = $this->conn->quote($address);
        
        $sql = "insert into users (name, age, address) values($name, $age, $address)";
        if($this->conn->query($sql)) {
            return true;
        }else {
            return false;
        }
    }

    public function read () {
        $sql = "select * from users order by id desc";
        $data = $this->conn->query($sql);
        if($data) {
            return $data;
        }
    }

    public function update ($id, $name, $age, $address) {
        $name = $this->conn->quote($name);
        $address = $this->conn->quote($address);
        $sql = "update users set name=$name, age=$age, address=$address where id = $id";
        if($this->conn->query($sql)){
            return true;
        }else {
            return false;
        }
    }

    public function delete ($id) {
        $sql = "delete from users where id = $id";
        if($this->conn->query($sql)){
            return true;
        }else {
            return false;
        }
    }

}