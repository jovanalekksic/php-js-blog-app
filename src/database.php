<?php

$host = "localhost";
$username = "root";
$password = "root";
$database = "blog";
$port = 3306;

$connection = new mysqli($host, $username, $password, $database, $port);

if ($connection->connect_error) {
    die("Connection failed. Error: " . $connection->connect_error);
}
