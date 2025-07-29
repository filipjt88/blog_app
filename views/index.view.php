<!-- Index page -->
<?php if (!isset($posts)) die('Nemate direktnog pristupa.');
$title = 'Home page';
require_once __DIR__ . '/../parts/top.php';
?>

<div class="container my-5">
    <?php include './parts/navbar.php'; ?>

    <h1 class="text-center mb-5 fw-bold display-5 mt-5">Blog postovi</h1>

    <?php if (isset($posts) && count($posts) > 0): ?>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden post-item" data-category="<?= htmlspecialchars($post['category_name']) ?>" style="transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <?php if (!empty($post['image'])): ?>
                            <img src="<?= htmlspecialchars($post['image']) ?>" alt="Slika posta" class="card-img-top" style="height: 180px; object-fit: cover;">
                        <?php else: ?>
                            <div class="bg-secondary bg-opacity-10 d-flex align-items-center justify-content-center" style="height: 180px;">
                                <span class="text-muted fst-italic">Nema slike</span>
                            </div>
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold mb-3">
                                <a href="single_post.php?id=<?= $post['id'] ?>" class="text-decoration-none text-dark">
                                    <?= nl2br(htmlspecialchars(mb_strimwidth($post['title'], 0, 40, '...'))) ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted mb-4" style="flex-grow: 1;">
                                <?= nl2br(htmlspecialchars(mb_strimwidth($post['content'], 0, 120, '...'))) ?>
                            </p>

                            <div class="mb-3 small text-secondary fst-italic">
                                <span><b>Kategorija:</b> <?= htmlspecialchars($post['category_name'] ?? 'Bez kategorije') ?></span> |
                                <span>Autor: <?= htmlspecialchars($post['username']) ?></span><br>
                                <span><b>Objavljeno:</b> <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?></span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <a href="single_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-primary rounded-pill px-4 shadow-sm" style="transition: background-color 0.3s ease;">
                                    Pročitaj više
                                </a>

                                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                                    <div class="btn-group" role="group" aria-label="Uredi post">
                                        <a href="./edit_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-warning" title="Izmeni">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="./delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Da li sigurno želiš da obrišeš post?');" title="Obriši">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center fs-5 mt-5" role="alert">
            Nema blog postova!
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>
<!-- End of Index page -->