<?php
if(!function_exists('showComments')) {
    function showComments($pdo, $post_id, $parent_id = null)
    {
        $sql = "SELECT c.*, u.username 
                FROM comments c 
                JOIN users u ON c.user_id = u.id 
                WHERE c.post_id = :post_id";
    
        if (is_null($parent_id)) {
            $sql .= " AND c.parent_id IS NULL";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['post_id' => $post_id]);
        } else {
            $sql .= " AND c.parent_id = :parent_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['post_id' => $post_id, 'parent_id' => $parent_id]);
        }
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($comments as $comment) {
            echo "<div class='mb-3 p-2' style='margin-left: 40px; border-left:2px solid #ccc;'>";
            echo "<strong>" . htmlspecialchars($comment['username']) . "</strong><br>";
            echo "<p>" . nl2br(htmlspecialchars($comment['content'])) . "</p>";
            echo "<small class='text-muted'>" . date('d.m.Y H:i', strtotime($comment['created_at'])) . "</small>";
    
            // Forma za odgovor (ako korisnik nije autor komentara)
            if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != $comment['user_id']) {
                echo "<form method='POST' class='mt-2'>
                        <input type='hidden' name='parent_id' value='{$comment['id']}'>
                        <textarea name='comment' class='form-control mb-2' rows='2' placeholder='Reply...'></textarea>
                        <button type='submit' class='btn btn-sm btn-secondary'>Reply</button>
                      </form>";
            }
            // Rekurzivno pozivanje za odgovore
            showComments($pdo, $post_id, $comment['id']);
            echo "</div>";
        }
    } 
}
