<?php
require "../../database.php";
require "../../models/Post.php";
require "../../models/Comment.php";

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "Post ID is missing.";
    exit();
}

$postId = $_GET['id'];
$post = Post::getPost($postId);

if (!$post) {
    echo "Post not found.";
    exit();
}

$comments = Comment::getAllCommentsByPostId($postId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../styles.css">
    <title>View Post</title>

</head>

<body>
    <div class="container">
        <div class="post">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $post['title'] ?></h2>
                    <p class="card-text"><?php echo $post['content']; ?></p>
                </div>
            </div>
        </div>

        <?php if ($post['user_id'] == $_SESSION['id']) { ?>
            <form action="deletePost.php" method="post" style="display:inline;">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <button type="submit" class="btn btn-danger">Delete Post</button>
            </form>
        <?php } ?>
        <button id="btnAddComment" class="btn btn-primary" data-toggle="modal" data-target="#modalAddComment">Add Comment</button>

        <div class="comment-container">
            <h3>Comments</h3>
            <?php foreach ($comments as $comment) { ?>
                <div class="comment">
                    <p><?php echo $comment['comment']; ?></p>
                    <?php if ($comment['user_id'] == $_SESSION['id']) { ?>
                        <form action="../comments/deleteComment.php" method="post" style="display:inline;">
                            <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                            <button type="submit" class="btn btn-danger">Delete Comment</button>
                        </form>
                        <button class="btn btn-warning btn-update-comment" data-id="<?php echo $comment['id']; ?>" data-comment="<?php echo $comment['comment']; ?>" data-toggle="modal" data-target="#modalUpdateComment">Update Comment</button>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Modal for adding a comment -->
    <div class="modal fade" id="modalAddComment" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="addCommentForm">
                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" id="comment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for updating a comment -->
    <div class="modal fade" id="modalUpdateComment" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="updateCommentForm">
                        <input type="hidden" id="updateCommentId" name="comment_id">
                        <div class="form-group">
                            <label for="updateComment">Comment</label>
                            <textarea class="form-control" id="updateComment" name="comment" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-warning">Update Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="javascript/script.js"></script>


    <script>
        $(document).ready(function() {
            $("#addCommentForm").submit(function(event) {
                event.preventDefault();
                const comment = $("#comment").val();
                const postId = "<?php echo $postId; ?>";
                $.ajax({
                    url: "../comments/addComment.php",
                    type: "POST",
                    data: {
                        comment: comment,
                        post_id: postId
                    },
                    success: function(response) {
                        if (response === "Success") {
                            location.reload();
                        } else {
                            alert("Error adding comment: " + response);
                        }
                    }
                });
            });

            $(".btn-update-comment").click(function() {
                const commentId = $(this).data("id");
                const commentText = $(this).data("comment");
                $("#updateCommentId").val(commentId);
                $("#updateComment").val(commentText);
            });

            $("#updateCommentForm").submit(function(event) {
                event.preventDefault();
                const commentId = $("#updateCommentId").val();
                const commentText = $("#updateComment").val();
                $.ajax({
                    url: "../comments/updateComment.php",
                    type: "POST",
                    data: {
                        comment_id: commentId,
                        comment: commentText
                    },
                    success: function(response) {
                        if (response === "Success") {
                            location.reload();
                        } else {
                            alert("Error updating comment: " + response);
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>