<?php
require "../../database.php";
require "../../models/Post.php";

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];

    $post = Post::getPost($postId);

    if ($post['user_id'] == $_SESSION['id']) {
        $result = Post::deletePost($postId);
        if ($result) {
            header('Location: ../../home.php');
            exit();
        } else {
            echo "Error deleting post.";
        }
    } else {
        echo "You are not authorized to delete this post.";
    }
}
