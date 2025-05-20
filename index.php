<?php 
include_once 'core/init.php';
include_once 'core/db.php'; 

if(!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

// Preuzimanje svih postova iz baze podataka
$stmt = $pdo->query("SELECT posts.*, users.username FROM posts LEFT JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll();

include 'views/index.view.php'; 
?>


