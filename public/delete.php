<?php

include_once "../classes/Database.php";
include_once "../classes/User.php";

$db = new Database();
$db = $db->getConnection();

$user = new User($db);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $id = $_GET['id'];
    if($user->delete($id)){
        header('location: index.php');
    }else {
        echo "Delete Failed";
    }
}