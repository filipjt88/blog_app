<?php 
include_once 'core/init.php';
include_once 'core/db.php'; 

if(!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

// Preuzimanje svih postova iz baze podataka
$stmt = $pdo->query("
    SELECT posts.*, users.username, categories.name AS category_name 
    FROM posts
    LEFT JOIN users ON posts.user_id = users.id
    LEFT JOIN categories ON posts.category_id = categories.id
    ORDER BY posts.created_at DESC
");
$posts = $stmt->fetchAll();


include 'views/index.view.php'; 
?>


