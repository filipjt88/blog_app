<?php
include_once 'core/db.php';
include_once 'core/init.php';

if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$post_id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT posts.*, users.username, categories.name AS category_name FROM posts LEFT JOIN users ON posts.user_id LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.id =?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post) {
    echo "<div class='container mt-5' class='alert alert-danger'>
    Post ne postoji!
    </div>";
    exit;
}

include 'views/single_post.view.php';

?>