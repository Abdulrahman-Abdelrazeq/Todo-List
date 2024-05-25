<?php

include_once '../classes/Database.php';
include_once '../classes/User.php';

$db = new Database();
$db = $db->getConnection();

$user = new User($db);
$users = $user->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo-List</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CSS -->
    <link href="../assets/css/style.css" rel="stylesheet">
    
</head>
<body>

    <main class="container pt-5">
        <div class="messages">
            <?php
            session_start();
            if (isset($_SESSION['message'])):
                echo "<div class='alert alert-" . ($_SESSION['message_type'] == 'success' ? 'success' : 'danger') . " alert-dismissible fade show' role='alert'>" . $_SESSION['message'] . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            endif;
            ?>
        </div>
        <div class="create d-flex align-items-center">

            <!-- Button trigger modal -->
            <button class="btn btn-primary" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createuser">Create New User</button>

            <!-- Modal For Create User -->
            <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="create.php">
                            <div class="modal-body">
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <h1 class="flex-grow-1 text-center">To-Do List For Users</h1>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Address</th>
                    <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $users->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td scope="row"><a href="show.php?id=<?=$row['id']?>" class="text-decoration-none text-dark"><?=$row['name'] ?></a></td>
                    <td><?=$row['age'] ?></td>
                    <td><?=$row['address'] ?></td>
                    <td>
                        <!-- Button trigger modal -->
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#updateuser<?=$row['id'] ?>">Edit</button>

                        <!-- Modal For Update User -->
                        <div class="modal fade" id="updateuser<?=$row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update user</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="update.php?id=<?=$row['id']?>">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputName" class="form-label">Fullname</label>
                                                <input type="text" name="name" value="<?=$row['name'] ?>" class="form-control" id="exampleInputName" aria-describedby="nameHelp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputAge" class="form-label">Age</label>
                                                <input type="text" name="age" value="<?=$row['age'] ?>" class="form-control" id="exampleInputAge">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputAddress" class="form-label">Address</label>
                                                <input type="text" name="address" value="<?=$row['address'] ?>" class="form-control" id="exampleInputAddress">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteuser<?=$row['id'] ?>">Delete</button>

                        <!-- Modal For Delete User -->
                        <div class="modal fade" id="deleteuser<?=$row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete user</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="delete.php?id=<?=$row['id']?>">
                                        <div class="modal-body">
                                            Are you sure?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>