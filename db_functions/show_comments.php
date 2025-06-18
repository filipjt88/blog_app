<?php
if(!function_exists('showComments')) {
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

        if (isset($_SESSION['user_id'])) {
            echo "<form method='POST' class='mt-2'>
                    <input type='hidden' name='parent_id' value='" . $comment['id'] . "'>
                    <textarea name='comment' class='form-control mb-2' rows='2' placeholder='Odgovor...'></textarea>
                    <button type='submit' class='btn btn-sm btn-secondary'>Odgovori</button>
                  </form>";
        }

        showComments($pdo, $post_id, $comment['id'], $margin + 40);
        echo "</div>";
    }
}
}
