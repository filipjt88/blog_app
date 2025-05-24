<?php if (!isset($posts)) die('Nema direktnog pristupa.');
$title = 'Home page';
require_once __DIR__ . '/../parts/top.php';
?>

<div class="container mt-5">
    <?php include './parts/navbar.php'; ?>
    <h1 class="text-center mt-5 mb-5">Blog postovi</h1>

    <?php if (isset($posts) && count($posts) > 0): ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-4">
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="text-center mb-5"><?= nl2br(htmlspecialchars(mb_strimwidth($post['title'], 0, 30, '...'))) ?></h5>
                            <p><?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 200, '...'))) ?></p>
                            <small class="text-muted">
                                Kategorija: <?= htmlspecialchars($post['category_name'] ?? 'Bez kategorije') ?> |
                                Autor: <?= htmlspecialchars($post['username']) ?> |
                                Datum: <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
                                <?php if (!empty($post['image'])): ?>
                                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="Slika posta" class="img-fluid" style="min-height:300px;object-fit:cover;">
                            </small>
                                <?php endif; ?>
                            <?php count($posts); ?>
                            <!-- Provera da li je korisnik autor posta -->
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                                <div class="footer pt-3">
                                    <a href="./edit_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Izmeni</a>
                                    <a href="./delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Da li sigurno želiš da obrišeš post?');">Obriši</a>
                                </div>
                        </div>
                    </div>
                <?php endif; ?>
                </div>
                <?php endforeach; ?>
        </div>
</div>
<?php else: ?>
    <h4 class="text-center mt-5">Nema postova!</h4>
<?php endif; ?>

<?php include './parts/bottom.php'; ?>