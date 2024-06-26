<?php
class User
{
    public $id;
    public $username;
    public $email;
    public $password;

    public function __construct($id, $username, $email, $password)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public static function createUser($username, $email, $password)
    {
        global $connection;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            return $connection->insert_id; // Return the ID of the newly created user
        } else {
            return false;
        }
    }


    static function getAllUsers()
    {
        global $connection;
        $resultSet = $connection->query("SELECT * FROM users");
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    }

    static function getUser($id)
    {
        global $connection;
        $statement = $connection->prepare("SELECT * FROM users WHERE id=?");
        $statement->bind_param("i", $id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    static function updateUser($id, $username, $email)
    {
        global $connection;
        $statement = $connection->prepare("UPDATE users SET username=?, email=? WHERE id=?");
        $statement->bind_param("ssi", $username, $email, $id);
        return $statement->execute();
    }

    static function deleteUser($id)
    {
        global $connection;
        $statement = $connection->prepare("DELETE FROM users WHERE id=?");
        $statement->bind_param("i", $id);
        return $statement->execute();
    }
    public static function logInUser($email, $password, $conn)
    {
        $statement = $conn->prepare("SELECT * FROM users WHERE email=?");
        $statement->bind_param("s", $email);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if ($result) {
            if (password_verify($password, $result['password'])) {
                return $result;
            } else {
                echo "Password verification failed<br>";
            }
        } else {
            echo "No user found with email: " . $email . "<br>";
        }

        return false;
    }
}
