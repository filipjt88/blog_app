<?php
session_start();
include_once 'core/db.php';
include_once 'core/init.php';

// Provera ID-a posta
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
$post_id = (int)$_GET['id'];

// Preuzimanje posta
$stmt = $pdo->prepare("SELECT posts.*, users.username, categories.name AS category_name FROM posts LEFT JOIN users ON posts.user_id = users.id LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post ne postoji!");
}  
} else {
    die("Neispravan ID posta!");
}

// Dodavanje komentara ili odgovora
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['comment']) && isset($_SESSION['user_id'])) {
    $comment = trim($_POST['comment']);
    $parent_id = isset($_POST['parent_id']) && is_numeric($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;
    $user_id = $_SESSION['user_id'];

    if (!empty($comment)) {
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content, created_at, parent_id) VALUES (?, ?, ?, NOW(), ?)");
        $stmt->execute([$post_id, $user_id, $comment, $parent_id]);
    }
    // Redirekcija da se spreči ponovno slanje forme
    header("Location: single_post.php?id=" . $post_id);
    exit;
}

// Brisanje komentara
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
    if($isAdmin) {
        // Admin moze obrisati svaki komentar
        $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
        $stmt->execute([$comment_id]);
    } else {
        // Korisnik moze obrisati samo svoj komentar
        $stmt = $pdo->prepare("DELETE from comments WHERE id = ? AND user_id = ?");
        $stmt->execute([$comment_id,$_SESSION['user_id']]);
    }
    header("Location: single_post.php?id=" . $_GET['id']);
    exit;
    // $comment_id = (int)$_POST['delete_comment_id'];
    // $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    // $stmt->execute([$comment_id, $_SESSION['user_id']]);
    // header("Location: single_post.php?id=" . $_GET['id']);
    // exit;
}

// Editovanje komentara
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment_id'], $_POST['edited_comment'])) {
    $comment_id = (int)$_POST['edit_comment_id'];
    $edited_content = trim($_POST['edited_comment']);
    if (!empty($edited_content)) {
        $stmt = $pdo->prepare("UPDATE comments SET content = ?, created_at = NOW() WHERE id = ? AND user_id = ?");
        $stmt->execute([$edited_content, $comment_id, $_SESSION['user_id']]);
    }
    header("Location: single_post.php?id=" . $_GET['id']);
    exit;
}


include 'views/single_post.view.php';
