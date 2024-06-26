<?php
require "../../database.php";
require "../../models/Post.php";

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['naziv']) && isset($_POST['autor'])) {
    $title = $_POST['naziv'];
    $content = $_POST['autor'];
    $user_id = $_SESSION['id'];
    $current_timestamp = date('Y-m-d H:i:s');


    $newPost = new Post(null, $user_id, $title, $content, $current_timestamp);
    $result = Post::createPost($newPost, $connection);

    if ($result === true) {
        echo "Success";
    } else {
        echo "Error creating post: " . $result;
    }
} else {
    echo "Invalid input data";
}
