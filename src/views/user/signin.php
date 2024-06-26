<?php
require "../../database.php";
require "../../models/USer.php";

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userId = User::createUser($username, $email, $password, $connection);

    if ($userId) {
        $_SESSION['id'] = $userId;
        header('Location: ../../home.php');
        exit();
    } else {
        echo 'Error signing up!<br>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <title>Sign-in</title>
    <style>
        html,
        body {
            height: 100%;
        }

        .form-container {
            height: 100%;
        }

        .form {
            max-width: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center form-container">
        <div class="form">
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Sign-in</button>
            </form>
        </div>
    </div>
</body>

</html>