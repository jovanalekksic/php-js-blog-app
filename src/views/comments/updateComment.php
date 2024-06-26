<?php
require "../../database.php";
require "../../models/Comment.php";

session_start();

if (!isset($_SESSION['id'])) {
    echo "Unauthorized";
    exit();
}

if (!isset($_POST['comment_id']) || !isset($_POST['comment'])) {
    echo "Missing data.";
    exit();
}

$commentId = $_POST['comment_id'];
$commentText = $_POST['comment'];
$comment = Comment::getComment($commentId);

if ($comment['user_id'] != $_SESSION['id']) {
    echo "Unauthorized";
    exit();
}

if (Comment::updateComment($commentId, $commentText)) {
    echo "Success";
} else {
    echo "Error updating comment.";
}
