<?php
include 'auth.php';
include 'user.php'; // Include user functions to validate credentials
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials against the database
    $user = validateUser($username, $password);

    if ($user) {
        // Set session variables upon successful login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to the dashboard or any other page as needed
        header("Location: dashboard.php");
        exit();
    } else {
        // If credentials are invalid, show an error message
        echo "Invalid username or password. Please try again.";
        // You can redirect back to the login page or handle the error accordingly
    }
}
?>

<!-- Create a simple form for user login -->
<form method="post" action="login.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
