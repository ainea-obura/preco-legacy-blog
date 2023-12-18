<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'db.php'; // Include your database connection

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Validate and sanitize input data before saving to the database (not implemented here)

    // Save the blog post to the database
    $userId = $_SESSION['user_id'];
    if (saveBlogPost($userId, $title, $content, $conn)) {
        $message = "Blog post created successfully!";
        header("Location: dashboard.php");
        exit(); 
    } else {
        $message = "Failed to create the blog post. Please try again.";
    }
}

// Function to save blog post in the database
function saveBlogPost($userId, $title, $content, $conn) {
    // Prepare and execute the SQL query to insert a new blog post
    $stmt = $conn->prepare("INSERT INTO blogs (user_id, title, content) VALUES (?, ?, ?)");
    
    // Use 's' for strings and 'i' for integers
    $stmt->bind_param("iss", $userId, $title, $content);

    return $stmt->execute(); // Return true if the execution is successful, else false
}
// function saveBlogPost($userId, $title, $content, $conn) {
//     // Prepare and execute the SQL query to insert a new blog post
//     $stmt = $conn->prepare("INSERT INTO blogs (user_id, title, content) VALUES (?, ?, ?)");
//     $stmt->bind_param("iss", $userId, $title, $content);

//     return $stmt->execute(); // Return true if the execution is successful, else false
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog Post</title>
    <!-- Add any CSS styles if needed -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h1>Create a New Blog Post</h1>
    <?php if ($message !== '') : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <form method="post" action="create_blog.php">
        <input type="text" name="title" placeholder="Blog Title" required><br><br>
        <textarea name="content" placeholder="Blog Content" required></textarea><br><br>
        <button type="submit">Create Post</button>
    </form>
</body>
</html>
