<?php 
$title = 'Single page';
require_once __DIR__ . '/../parts/top.php';
?>

<div class="container mt-5">
    <?php include './parts/navbar.php'; ?>
    <div class="row">
        <div class="col-md-8 offset-2">
            <div class="card shadow-sm mt-5">
        <?php if (!empty($post['image'])): ?>
            <img src="<?= htmlspecialchars($post['image']) ?>" class="card-img-top" alt="Slika posta" style="max-height: 800px; object-fit: cover;">
        <?php endif; ?>

        <div class="card-body">
            <h1 class="card-title"><?= htmlspecialchars($post['title']) ?></h1>
            <div class="mb-2 text-muted">
                <span><strong>Autor:</strong> <?= htmlspecialchars($post['username']) ?></span> |
                <span><strong>Kategorija:</strong> <?= htmlspecialchars($post['category_name'] ?? 'Nema') ?></span> |
                <span><strong>Datum:</strong> <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?></span>
            </div>
            <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        </div>
    </div>

      <div class="card-body">
         <h4 class="mt-5 text-center">Vas komentar</h4>
    <?php if(isset($_SESSION['user_id'])) : ?>
        <form method='POST' class='mb-4'>
            <textarea name='comment' class='form-control' rows='6' placeholder='Please your comment...'></textarea>
            <button type='submit' class='btn btn-sm btn-success mt-3'>Posalji svoj komentar</button>
        </form>
        <?php else: ?>
            <p class='text-center'>Morate biti prijavljeni da biste ostavili svoj komentar!</p>
        <?php endif; ?>
            <h3 class="card-title text-center">Komentari</h3>
            <div class="mb-2 text-muted">
               <?php showComments($pdo, $post_id); ?>
            </div>
            <?php showAnswer($comment_id, $comment_user_id); ?>
        </div>
         <a href="index.php" class="btn btn-outline-dark mt-5 mb-5">← Nazad na sve postove</a>
    </div>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php';  ?>