<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$post_id = intval($_GET['id'] ?? 0);
$user_id = $_SESSION['user_id'];

// Query base table 'blogpost' directly
$stmt = $conn->prepare("DELETE FROM blogpost WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();

header("Location: blog_posts.php");
exit();
?>