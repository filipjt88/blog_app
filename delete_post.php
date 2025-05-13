<?php
session_start();
require_once 'core/db.php';

if(!isset($_GET['id']) || !isset($_SESSION['user_id'])) {
    header("Location: ./views/index.view.php");
    exit;
}

$post_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Provera da li korisnik uopste ima pravo da obrise POST?!
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
$post = $stmt->fetch();

if(!$post) {
    header("Location: ./views/index.view.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
$stmt->execute(['id' => $post_id]);

header("Location: ./views/index.view.php");
exit;

?>