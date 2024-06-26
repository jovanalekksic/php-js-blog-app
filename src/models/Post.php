<?php

class Post
{
    public $id;
    public $user_id;
    public $title;
    public $content;
    public $created_at;

    public function __construct($id, $user_id, $title, $content, $created_at)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
    }


    static function createPost(Post $post, mysqli $connection)
    {
        $statement = $connection->prepare("INSERT INTO posts(user_id, title, content, created_at) VALUES (?, ?, ?,?)");
        $statement->bind_param("isss", $post->user_id, $post->title, $post->content, $post->created_at);

        if ($statement->execute()) {
            return true;
        } else {
            return "Error: " . $statement->error;
        }
    }

    static function getAllPosts(mysqli $connection)
    {
        return  $connection->query("SELECT * FROM posts");
    }

    static function getPost($id)
    {
        global $connection;
        $statement = $connection->prepare("SELECT * FROM posts WHERE id=?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    static function updatePost($id, $title, $content)
    {
        global $connection;
        $statement = $connection->prepare("UPDATE posts SET title=?, content=? WHERE id=?");
        $statement->bind_param("ssi", $title, $content, $id);
        return $statement->execute();
    }

    static function deletePost($id)
    {
        global $connection;
        $statement = $connection->prepare("DELETE FROM posts WHERE id=?");
        $statement->bind_param("i", $id);
        return $statement->execute();
    }
}
