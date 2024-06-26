<?php
require "../../database.php";
require "../../models/Comment.php";

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment']) && isset($_POST['post_id'])) {
    $commentText = $_POST['comment'];
    $postId = $_POST['post_id'];
    $userId = $_SESSION['id'];
    $createdAt = date('Y-m-d H:i:s');

    $result = Comment::createComment($postId, $userId, $commentText, $createdAt);

    if ($result) {
        echo "Success";
    } else {
        echo "Error adding comment.";
    }
}
