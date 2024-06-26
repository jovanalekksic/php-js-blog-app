<?php
require "database.php";
require "models/User.php";

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $response = User::logInUser($email, $password, $connection);


    if ($response) {
        $_SESSION['id'] = $response['id'];
        header('Location: home.php');
        exit();
    } else {
        echo 'Error logging in!<br>';
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
    <title>Prijava</title>
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
                    <label for="username">Email</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Login</button>
                <p>Don't have an account? <a href="views/user/signin.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>

</html>