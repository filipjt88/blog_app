<?php
session_start();
include_once 'core/db.php';
include_once 'core/init.php';
include_once 'db_functions/show_comments.php';
// Funkcija koja prikazuje komentare
function showComments($pdo, $post_id, $parent_id = null, $margin = 0)
{
    $sql = "SELECT c.*, u.username 
            FROM comments c 
            JOIN users u ON c.user_id = u.id 
            WHERE c.post_id = :post_id AND ";

    $sql .= is_null($parent_id) ? "c.parent_id IS NULL " : "c.parent_id = :parent_id ";
    $sql .= "ORDER BY c.created_at ASC";

    $stmt = $pdo->prepare($sql);

    if (is_null($parent_id)) {
        $stmt->execute(['post_id' => $post_id]);
    } else {
        $stmt->execute(['post_id' => $post_id, 'parent_id' => $parent_id]);
    }

    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($comments as $comment) {
        echo "<div class='mb-3 p-2' style='margin-left: {$margin}px; border-left: 2px solid #ccc;'>";
        echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
        echo "<p>" . nl2br(htmlspecialchars($comment['content'])) . "</p>";
        echo "<small class='text-muted'>" . date('d.m.Y H:i', strtotime($comment['created_at'])) . "</small>";

        // Forma za odgovor
        if (isset($_SESSION['user_id'])) {
            echo "<form method='POST' class='mt-2'>
                    <input type='hidden' name='parent_id' value='" . $comment['id'] . "'>
                    <textarea name='comment' class='form-control mb-2' rows='2' placeholder='Odgovor...'></textarea>
                    <button type='submit' class='btn btn-sm btn-secondary'>Odgovori</button>
                  </form>";
        }
        // Pozivanje odgovora
        showComments($pdo, $post_id, $comment['id'], $margin + 40);
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
