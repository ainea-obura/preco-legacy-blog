<?php
include 'db.php';
include 'comments.php'; // Include the comments functions
include 'functions.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['blog_id'], $_POST['comment'])) {
        $blogId = $_POST['blog_id'];
        $comment = $_POST['comment'];

        // Add the comment to the database
        if (addComment($blogId, $comment)) {
            // Redirect back to the blog page after adding the comment
            header("Location: blog.php?id=$blogId");
            exit();
        } else {
            echo "Failed to add comment.";
            // Handle failure to add comment
        }
    } else {
        echo "Invalid data received.";
        // Handle invalid data received
    }
} else {
    echo "Invalid request method.";
    // Handle invalid request method
}
?>
