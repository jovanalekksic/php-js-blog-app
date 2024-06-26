<?php
require "../../database.php";
require "../../models/Post.php";

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id']) && isset($_POST['title']) && isset($_POST['content'])) {
    $postId = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $post = Post::getPost($postId);

    if ($post['user_id'] == $_SESSION['id']) {
        $result = Post::updatePost($postId, $title, $content);
        if ($result) {
            header('Location: ../../home.php');
            exit();
        } else {
            echo "Error updating post.";
        }
    } else {
        echo "You are not authorized to update this post.";
    }
}
