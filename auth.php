<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function logout() {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>