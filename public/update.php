<?php

include_once '../classes/Database.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $id = $_GET['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    if($user->update($id, $name, $age, $address)){
        header("location: index.php");
    }else {
        echo "Update Failed";
    }
}
