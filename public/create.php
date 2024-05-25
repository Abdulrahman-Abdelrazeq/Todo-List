<?php
include_once '../classes/Database.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    
    if ($user->create($name, $age, $address)) {
        header('location: index.php');
    } else {
        echo "User could not be created.";
    }
}
?>

<!-- <form method="POST" action="create.php">
    <div class="mb-3">
        <label for="exampleInputName" class="form-label">Fullname</label>
        <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="nameHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputAge" class="form-label">Age</label>
        <input type="text" name="age" class="form-control" id="exampleInputAge">
    </div>
    <div class="mb-3">
        <label for="exampleInputAddress" class="form-label">Address</label>
        <input type="text" name="address" class="form-control" id="exampleInputAddress">
    </div>
    <button type="submit" class="btn btn-primary">Add</button>
</form> -->