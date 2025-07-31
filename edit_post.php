
<?php 
session_start();
require_once 'core/db.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

if(!isset($_GET['id'])) {
    header("Location:views/index.view.php");
}

$post_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
$stmt->execute(['id' => $post_id]);
$post = $stmt->fetch();

// Provera da li postoji user i da li je vlasnik objave
if(!$post || $post['user_id'] != $_SESSION['user_id']) {
    header("Location: index.php");
    exit;
}

include 'views/edit_post.view.php';
?>


