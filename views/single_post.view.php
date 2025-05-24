<?php if (!isset($posts)) die('Nema direktnog pristupa.');
$title = 'Single page';
require_once __DIR__ . '/../parts/top.php';
?>

<div class="container mt-5">
    <a href="index.php" class="btn btn-outline-secondary mb-4">← Nazad na sve postove</a>

    <div class="card shadow-sm">
        <?php if (!empty($post['image'])): ?>
            <img src="<?= htmlspecialchars($post['image']) ?>" class="card-img-top" alt="Slika posta" style="max-height: 400px; object-fit: cover;">
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
</div>

<?php require_once __DIR__ . '/../parts/bottom.php';  ?>