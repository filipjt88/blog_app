<?php
session_start();
require_once 'core/db.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $post_id = $_POST['id'];
    $title   = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if(empty($title) || empty($content)) {
        header("Location: edit_post.php?id=" .$post_id . '&error' .urlencode("Sva polja su obavezna"));
        exit;
    }

    // Proveri da li korisnik ima pravo da menja POST
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $post_id, 'user_id' => $user_id]);
    $post = $stmt->fetch();

    if(!$post) {
        header("Location: index.php");
        exit;
    }
    
    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id");
    $stmt->execute(['title' => $title, 'content' => $content, 'id' => $post_id]);
    header("Location: index.php");
}