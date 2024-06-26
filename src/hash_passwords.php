<?php
require "database.php";

// Fetch all users with plain-text passwords
$users = $connection->query("SELECT id, password FROM users");

while ($user = $users->fetch_assoc()) {
    $userId = $user['id'];
    $plainPassword = $user['password'];
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Update the user's password with the hashed password
    $stmt = $connection->prepare("UPDATE users SET password=? WHERE id=?");
    $stmt->bind_param("si", $hashedPassword, $userId);
    $stmt->execute();
}

echo "All passwords have been hashed.";
