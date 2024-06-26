<?php
require "database.php";
require "models/Post.php";

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$result = Post::getAllPosts($connection);

if (!$result) {
    echo "Error in query <br>";
    die();
}

if ($result->num_rows == 0) {
    echo "There are no posts in database";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Posts</title>


</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Recipes</h1>
            <div class="header-buttons">
                <button id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#modaladd">Add post</button>
                <form action="views/user/logout.php" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-secondary">Logout</button>
                </form>
            </div>
        </div>
        <?php while ($post = $result->fetch_assoc()) { ?>
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title"><?php echo $post['title'] ?></h2>
                    <p class="card-text"><?php echo $post['content']; ?></p>
                    <?php if ($post['user_id'] == $_SESSION['id']) { ?>
                        <button class="btn btn-warning btn-update" data-id="<?php echo $post['id']; ?>" data-title="<?php echo $post['title']; ?>" data-content="<?php echo $post['content']; ?>" data-toggle="modal" data-target="#modalUpdate">Update</button>
                    <?php } ?>
                    <a href="views/posts/readPost.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">View post</a>
                </div>
            </div>
        <?php } ?>
    </div>





    <!-- Modal for adding a post -->
    <div class="modal fade" id="modaladd" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container ">
                        <form action="#" method="POST" id="addPostModal">
                            <h3 style="color: black; text-align: center">Add a new post</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" style="border: 1px solid black" name="naziv" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Content</label>
                                        <input type="text" style="border: 1px solid black" name="autor" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnAdd" type="submit" class="btn btn-success btn-block">Add post</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for updating a post -->
    <div class="modal fade" id="modalUpdate" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container ">
                        <form action="views/posts/updatePost.php" method="POST" id="updateForm">
                            <h3 style="color: black; text-align: center">Update Post</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group">
                                        <label for="updateTitle">Title</label>
                                        <input type="text" style="border: 1px solid black" name="title" id="updateTitle" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="updateContent">Content</label>
                                        <textarea class="form-control" id="updateContent" name="content" required></textarea>

                                    </div>
                                    <input type="hidden" name="post_id" id="updatePostId">
                                    <div class="form-group">
                                        <button id="btnUpdate" type="submit" class="btn btn-success btn-block">Update post</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="javascript/script.js"></script>
</body>

</html>