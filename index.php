<?php 
include_once 'core/init.php';
include_once 'core/db.php'; 

if(!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

$category = isset($_GET['categories']) ? $_GET['categories'] : null;

if($category) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE categories = ?");
    $stmt->execute([$category]);
} else {
    $stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
}
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preuzimanje svih postova iz baze podataka
$stmt = $pdo->query("SELECT posts.*, users.username, categories.name AS category_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id ORDER BY posts.created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
include 'views/index.view.php'; 
?>


