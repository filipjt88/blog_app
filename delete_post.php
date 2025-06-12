<?php
session_start();
require_once 'core/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: ./views/login.view.php");
    exit;
}

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: ./views/index.view.php");
    exit;
}

$post_id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if($post && !empty($post['image'])) {
    $image_path = 'uploads/' . $post['image'];

    if(file_exists($image_path)) {
        unlink($image_path);
    }
}

if(!$post || $post['user_id'] != $_SESSION['user_id']) {
    header("Location: index.php");
    exit;
}

// Obrisi Post
$delete = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$delete->execute([$post_id]);
header("Location: index.php");
exit;
?>
