<?php 
session_start();
require_once 'core/db.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if(empty($title) || empty($content)) {
        header('Location: create_blog_post.php?error=' .urlencode("Sva polja su obavezna!"));
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)");
    $stmt->execute(['title' => $title, 'content' => $content, 'user_id' => $user_id]);
    header("Location: views/index.view.php");
    exit;
} else {
    header("Location: create_blog_post.php");
}
?>