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

if(!$post || $post['user_id'] != $_SESSION['user_id']) {
    header("Location: index.php");
    exit;
}

if(!empty($post['image'])) {
    $image_filname = basename($post['image']);
    $image_path = __DIR__ . '/uploads/' . $image_filname;

    if(file_exists($image_path)) {
        if(!unlink($image_path)) {
            error_log("Nije moguce obrisati sliku:" .$image_path);
        }
    } else {
        error_log("Fajl ne postoji:" .$image_path);
    }
}

// Obrisi Post
$delete = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$delete->execute([$post_id]);
header("Location: index.php");
exit;
?>
