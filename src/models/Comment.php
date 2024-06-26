<?php

class Comment
{
    public $id;
    public $post_id;
    public $user_id;
    public $comment;
    public $created_at;

    public function __construct($id, $post_id, $user_id, $comment, $created_at)
    {
        $this->id = $id;
        $this->post_id = $post_id;
        $this->user_id = $user_id;
        $this->comment = $comment;
        $this->created_at = $created_at;
    }

    static function createComment($post_id, $user_id, $comment, $created_at)
    {
        global $connection;
        $statement = $connection->prepare("INSERT INTO comments(post_id, user_id, comment, created_at) VALUES(?,?,?,?)");
        $statement->bind_param("iiss", $post_id, $user_id, $comment, $created_at);
        return $statement->execute();
    }

    static function getAllComments()
    {
        global $connection;
        $resultSet = $connection->query("SELECT * FROM comments");
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    }
    static function getComment($id)
    {
        global $connection;
        $statement = $connection->prepare("SELECT * FROM comments WHERE id=?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }
    static function getAllCommentsByPostId($post_id)
    {
        global $connection;
        $statement = $connection->prepare("SELECT * FROM comments WHERE post_id = ?");
        $statement->bind_param("i", $post_id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function updateComment($id, $comment)
    {
        global $connection;
        $stmt = $connection->prepare("UPDATE comments SET comment = ? WHERE id = ?");
        $stmt->bind_param("si", $comment, $id);
        return $stmt->execute();
    }


    static function deleteComment($id)
    {
        global $connection;
        $stmt = $connection->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
