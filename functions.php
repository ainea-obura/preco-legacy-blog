<?php
// Place your function definitions here
// function getBlogDetails($blogId) {
//     // Function logic...
// }
function getBlogDetails($blogId) {
    global $conn; // Assuming $conn is your database connection variable

    // Prepare and execute the SQL query to fetch blog details
    $stmt = $conn->prepare("SELECT title, content FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $blogId);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        // Handle SQL error
        echo "Error: " . $conn->error;
        return false;
    }

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); // Return blog details if found
    } else {
        return false; // Blog not found
    }
}

function addComment($blogId, $comment) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO comments (blog_id, comment) VALUES (?, ?)");
    $stmt->bind_param("is", $blogId, $comment);

    return $stmt->execute(); // Return true if comment insertion is successful, else false
}
?>
