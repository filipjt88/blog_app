<!-- Index page -->
<?php if (!isset($posts)) die('Nemate direktnog pristupa.');
$title = 'Home page';
require_once __DIR__ . '/../parts/top.php';
?>

<div class="container post-container mt-5">
    <?php include './parts/navbar.php'; ?>
    <h1 class="text-center mt-5 mb-5">Blog postovi</h1>

    <?php if (isset($posts) && count($posts) > 0): ?>
        <div class="row">
            <?php foreach ($posts as $post): ?>
                <div class="col-md-3 mb-5">
                    <div class="card mt-5 h-100 post-item" data-category="<?= htmlspecialchars($post['category_name']) ?>">
                        <?php if (!empty($post['image'])): ?>
                            <img src="<?= htmlspecialchars($post['image']) ?>" alt="Slika posta" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-center mb-5">
                                <a href="single_post.php?id=<?= $post['id'] ?>" class="text-decoration-none text-dark">
                                    <?= nl2br(htmlspecialchars(mb_strimwidth($post['title'], 0, 30, '...'))) ?>
                                </a>
                            </h5>
                            <p class="card-text"><?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 100, '...'))) ?></p>

                            <small class="text-muted d-block" data-category>
                                <b>Kategorija:</b><?= htmlspecialchars($post['category_name'] ?? 'Bez kategorije') ?> |
                                Autor: <?= htmlspecialchars($post['username']) ?> </br>
                                <b>Datum objave: </b><?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
                            </small>

                            <a href="single_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-dark mt-4
                            ">Pročitaj više</a>

                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                                <div class="pt-3 d-flex justify-content-between">
                                    <a href="./edit_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Izmeni</a>
                                    <a href="./delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Da li sigurno želiš da obrišeš post?');">Obriši</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <h4 class="text-center mt-5">Nema blog postova!</h4>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>
<!-- End of Index page -->