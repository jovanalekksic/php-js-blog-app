<?php
require "../../database.php";
require "../../models/Comment.php";

session_start();

if (!isset($_SESSION['id'])) {
    echo "Unauthorized";
    exit();
}

if (!isset($_POST['comment_id'])) {
    echo "Comment ID is missing.";
    exit();
}

$commentId = $_POST['comment_id'];
$comment = Comment::getComment($commentId);

if ($comment['user_id'] != $_SESSION['id']) {
    echo "Unauthorized";
    exit();
}

if (Comment::deleteComment($commentId)) {
    header('Location: ../../home.php');
} else {
    echo "Error deleting comment.";
}
