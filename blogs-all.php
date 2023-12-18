<?php
include 'db.php';
include 'functions.php';

// Retrieve all blog posts from the database
function getAllBlogs() {
    global $conn;

    $sql = "SELECT id, title, content FROM blogs";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Return an empty array if no blogs found
    }
}

// Fetch all blogs
$blogs = getAllBlogs();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Blogs</title>
    <!-- Add any CSS styles if needed -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h1>All Blogs</h1>
    <?php if (!empty($blogs)) : ?>
        <ul>
            <?php foreach ($blogs as $blog) : ?>
                <li>
                    <a href="blog.php?id=<?php echo $blog['id']; ?>">
                        <h2><?php echo $blog['title']; ?></h2>
                    </a>
                    <p><?php echo $blog['content']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No blogs found.</p>
    <?php endif; ?>
</body>
</html>
