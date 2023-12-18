<?php
include 'user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a new user in the database
    $result = createUser($username, $password);

    if ($result) {
        // User creation successful
        //echo "Registration successful! You can now login.";
        header("Location: login.php");
        exit(); 
    } else {
        // User creation failed
        echo "Registration failed. Please try again.";
        // You can redirect back to the registration page
    }
}
?>

<!-- Form for user registration -->
<form method="post" action="register.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
</form>
