<?php
// Init
define('BASE_URL', '/blog_app/');

if(isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT id, username, role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $currentUser = $stmt->fetch(PDO::FETCH_ASSOC);
}

$isAdmin = isset($currentUser['role']) && $currentUser['role'] === 'admin';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}