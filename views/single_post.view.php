<!-- Single post -->
<?php
$title = 'Single page';
require_once __DIR__ . '/../parts/top.php';
require_once __DIR__ . '/../db_functions/show_comments.php';
?>
  <div class="container my-5">
    <?php include './parts/navbar.php'; ?>

    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- Naslov i slika -->
            <article class="mb-5 border-bottom pb-4 mt-5">
                <h1 class="mb-3 fw-bold"><?= htmlspecialchars($post['title']) ?></h1>

                <?php if (!empty($post['image'])): ?>
                    <img src="<?= htmlspecialchars($post['image']) ?>" alt="Slika posta" class="img-fluid rounded mb-4 shadow-sm" style="max-height: 380px; object-fit: cover; width: 100%;">
                <?php endif; ?>

                <!-- Meta informacije -->
                <div class="text-muted small mb-4 d-flex flex-wrap gap-3">
                    <span><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($post['username']) ?></span>
                    <span><i class="bi bi-tag me-1"></i><?= htmlspecialchars($post['category_name'] ?? 'Bez kategorije') ?></span>
                    <span><i class="bi bi-clock me-1"></i><?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>h</span>
                </div>

                <!-- Sadržaj -->
                <div class="fs-5 lh-lg text-dark">
                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                </div>
            </article>

            <!-- Komentari -->
            <section class="mb-5">
                <h4 class="mb-3">Komentari</h4>

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <form method="POST" class="mb-4">
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="comment" placeholder="Komentar" id="floatingTextarea" style="height: 120px;"></textarea>
                            <label for="floatingTextarea">Ostavite komentar</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Pošalji</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-light text-muted">Prijavite se da ostavite komentar.</div>
                <?php endif; ?>

                <!-- Prikaz komentara -->
                <div class="mt-4">
                    <?php showComments($pdo, $post_id); ?>
                </div>
            </section>

            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Nazad</a>
            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php';  ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>
<!-- End of Single post -->