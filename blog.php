<?php
include 'db.php';
include 'functions.php';
include 'comments.php'; 

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if blog ID is provided in the URL
if (isset($_GET['id'])) {
    $blogId = $_GET['id'];
    $blogDetails = getBlogDetails($blogId); // Assuming getBlogDetails() retrieves blog details
} else {
    // If no blog ID is provided in the URL
    $blogDetails = false;
}

// Fetch comments for this blog
$comments = getComments($blogId);
?>

<!-- Display individual blog with comments/reviews section -->
<?php if ($blogDetails) : ?>
    <h2><?php echo $blogDetails['title']; ?></h2>
    <p><?php echo $blogDetails['content']; ?></p>
<?php else : ?>
    <p>Blog not found.</p>
<?php endif; ?>

<!-- Display comments -->
<h3>Comments</h3>
<?php foreach ($comments as $comment) : ?>
    <!-- <p><?php echo $comment['user_id']; ?>: <?php echo $comment['comment']; ?></p> -->
    <p><?php echo $comment['comment']; ?></p>
<?php endforeach; ?>

<!-- Form to add a new comment -->
<form method="post" action="add_comment.php">
    <input type="hidden" name="blog_id" value="<?php echo $blogId ?? ''; ?>">
    <textarea name="comment" placeholder="Add your comment" required></textarea>
    <button type="submit">Add Comment</button>
</form>
