<?php
include 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
function createUser($username, $password) {
    global $conn;

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert a new user
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        return true; // User creation successful
    } else {
        return false; // User creation failed
    }
}

function updateUserProfile($userId, $newData) {
    global $conn;

    // Assuming $newData is an associative array containing updated user information
    $username = $newData['username'];
    // Add other fields as needed

    // Prepare and execute the SQL query to update user profile
    $stmt = $conn->prepare("UPDATE users SET username = ? WHERE id = ?");
    $stmt->bind_param("si", $username, $userId);

    if ($stmt->execute()) {
        return true; // Profile update successful
    } else {
        return false; // Profile update failed
    }
}

function validateUser($username, $password) {
    global $conn;

    // Retrieve user details from the database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            return $user; // Return user data if credentials are valid
        }
    }
    return false; // Return false if credentials are invalid
}

?>
