<?php
session_start();
require_once 'core/db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];


    if (empty($title) || empty($content)) {
        header('Location: create_blog_post.php?error=' . urlencode("Sva polja su obavezna!"));
        exit;
    }
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, category_id, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute([$title, $content, $_SESSION['user_id'], $category_id]);
    header("Location: index.php");
    exit;
} else {
    header("Location: create_blog_post.php");
}
