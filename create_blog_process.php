<?php
session_start();
require_once 'core/db.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : null;

    $image_path = null;

    // Provera i upload slike
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image_name = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            }
        }
    }

    if (empty($title) || empty($content)) {
        header('Location: create_blog_post.php?error=' . urlencode("Sva polja su obavezna!"));
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, created_at, category_id, image) VALUES (?, ?, ?, NOW()), ?, ?");
    $stmt->execute([$title, $content, $user_id, $category_id, $image_path]);
    header("Location: index.php");
    exit;
} else {
    header("Location: create_blog_post.php");
}
