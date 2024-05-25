<?php

include_once "../classes/Database.php";
include_once "../classes/User.php";

$db = new Database();
$db = $db->getConnection();

$user = new User($db);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $id = $_GET['id'];
    session_start();
    if($user->delete($id)){
        $_SESSION['message'] = "User deleted successfully";
        $_SESSION['message_type'] = "success";
        header('location: index.php');
        exit();
    }else {
        $_SESSION['message'] = "User deleted Failed";
        $_SESSION['message_type'] = "error";
    }
}