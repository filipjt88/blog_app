<?php session_start(); ?>
<?php include_once 'core/db.php'; ?>
<?php $title = 'Home page'; ?>
<?php include 'parts/top.php'; ?>
<?php include 'parts/navbar.php'; ?>

<?php

if(!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

// Preuzimanje svih postova iz baze podataka
$stmt = $pdo->query("SELECT posts.*, users.username FROM posts LEFT JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();
?>

<?php include 'views/index.view.php'; ?>





<?php include 'parts/bottom.php'; ?>

