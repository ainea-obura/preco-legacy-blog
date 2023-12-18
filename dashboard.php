<?php
include 'auth.php';

if (!isLoggedIn()) {
    header("Location: index.php");
    exit();
}

// Display user-specific options like creating/editing/deleting blogs
?>

<!-- User Dashboard -->
<h1>Welcome to your Dashboard</h1>
<p>Here, you can manage your blogs and profile.</p>
<!-- Add links/buttons for managing blogs and profile -->
<a href="create_blog.php">Create a New Blog</a>
<a href="blogs-all.php">View Blogs</a>
<a href="edit_profile.php">Edit Profile</a>
<a href="logout.php">Logout</a>
