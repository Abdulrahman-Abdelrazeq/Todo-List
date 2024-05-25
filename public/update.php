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
    session_start();
    if($user->update($id, $name, $age, $address)){
        $_SESSION['message'] = "User updated successfully";
        $_SESSION['message_type'] = "success";
        header("location: index.php");
        exit();
    }else {
        $_SESSION['message'] = "User updated Failed";
        $_SESSION['message_type'] = "error";
    }
}
