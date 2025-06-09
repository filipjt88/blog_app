<?php
session_start();
include_once 'core/db.php';
include_once 'core/init.php';

// Funkcija koja prikazuje komentare
function showComments($pdo, $post_id, $parent_id = null, $margin = 0)
{
    $query = "SELECT c.*, u.username 
              FROM comments c 
              JOIN users u ON c.user_id = u.id 
              WHERE c.post_id = :post_id";

    if ($parent_id === null) {
        $query .= " AND c.parent_id IS NULL";
    } else {
        $query .= " AND c.parent_id = :parent_id";
    }

    $query .= " ORDER BY c.created_at ASC";

    $stmt = $pdo->prepare($query);
    $params = ['post_id' => $post_id];
    if ($parent_id !== null) {
        $params['parent_id'] = $parent_id;
    }

    $stmt->execute($params);
    $comments = $stmt->fetchAll();

    foreach ($comments as $comment) {
        echo "<div class='mb-3' style='margin-left:{$margin}px;'>";
        echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
        echo "<p>" . nl2br(htmlspecialchars($comment['content'])) . "</p>";
        echo "<small class='text-muted'>" . date('d.m.Y H:i', strtotime($comment['created_at'])) . "</small>";

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $comment['user_id']) {
            echo "<form method='POST' class='mt-2'>
        <input type='hidden' name='parent_id' value='{$comment['id']}'>
        <textarea name='comment' class='form-control mb-2' rows='1' placeholder='Odgovori...'></textarea>
        <button type='submit' class='btn btn-sm btn-secondary'>Odgovori</button>
    </form>";
        }


        echo "</div>";

        // Rekurzivni prikaz odgovora
        showComments($pdo, $post_id, $comment['id'], $margin + 40);
    }
}

// Provera ID-a posta
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$post_id = (int)$_GET['id'];

// Dohvatanje posta
$stmt = $pdo->prepare("SELECT posts.*, users.username, categories.name AS category_name 
                       FROM posts 
                       LEFT JOIN users ON posts.user_id = users.id 
                       LEFT JOIN categories ON posts.category_id = categories.id 
                       WHERE posts.id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Post ne postoji!</div></div>";
    exit;
}

// Dodavanje komentara ili odgovora
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['comment']) && isset($_SESSION['user_id'])) {
    $comment = trim($_POST['comment']);
    $parent_id = isset($_POST['parent_id']) && is_numeric($_POST['parent_id']) ? $_POST['parent_id'] : null;
    $user_id = $_SESSION['user_id'];

    if (!empty($comment)) {
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, parent_id, content) VALUES (?, ?, ?, ?)");
        $stmt->execute([$post_id, $user_id, $parent_id, $comment]);
    }

    header("Location: single_post.php?id=" . $post_id);
    exit;
}


include 'views/single_post.view.php';
