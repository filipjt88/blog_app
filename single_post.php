<?php
session_start();
include_once 'core/db.php';
include_once 'core/init.php';

// Funkcija koja prikazuje komentare
function showComments($pdo, $post_id, $parent_id = null)
{
    $query = "SELECT c.*, u.username FROM comments c
              JOIN users u ON c.user_id = u.id
              WHERE c.post_id = :post_id";

    if (is_null($parent_id)) {
        $query .= " AND c.parent_id IS NULL";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['post_id' => $post_id]);
    } else {
        $query .= " AND c.parent_id = :parent_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['post_id' => $post_id, 'parent_id' => $parent_id]);
    }

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    var_dump($comments);
    foreach ($comments as $comment) {
        echo "<div class='mb-3 p-2' style='margin-left:40px; border-left:2px solid #ccc;'>";
        echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
        echo "<p>" . nl2br(htmlspecialchars($comment['content'])) . "</p>";
        echo "<small class='text-muted'>" . date('d.m.Y H:i', strtotime($comment['created_at'])) . "</small>";

        if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $comment['user_id']) {
            echo "<form method='POST' class='mt-2'>
                    <input type='hidden' name='parent_id' value='{$comment['id']}'>
                    <textarea name='comment' class='form-control mb-2' rows='2' placeholder='Reply...'></textarea>
                    <button type='submit' class='btn btn-sm btn-secondary'>Reply</button>
                  </form>";
        }
        // Rekurzivni prikaz odgovora
        showComments($pdo, $post_id, $comment['id']);
        echo "</div>";
    }
}


// Brisanje komentara
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment_id'])) {
    $comment_id = (int)$_POST['delete_comment_id'];

    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ? AND user_id = ?");
    $stmt->execute([$comment_id, $_SESSION['user_id']]);

    header("Location: single_post.php?id=" . $_GET['id']);
    exit;
}

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
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, content, created_at, parent_id) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$post_id, $user_id, $comment, $parent_id]);
    }

    // Redirekcija da se spreči ponovno slanje forme
    header("Location: single_post.php?id=" . $post_id);
    exit;
}

include 'views/single_post.view.php';
