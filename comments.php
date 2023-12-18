<?php
// Include database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';

// Function to retrieve comments for a specific blog
function getComments($blogId) {
    global $conn;

    $stmt = $conn->prepare("SELECT comment FROM comments WHERE blog_id = ?");
    $stmt->bind_param("i", $blogId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Return an empty array if no comments found
    }
}
?>
