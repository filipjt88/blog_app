<?php
$title = 'Home page';
require_once __DIR__ . '/../parts/top.php';

?>

   <div class="container mt-5">
    <h2 class="text-center">Svi postovi</h2>
    <section class="d-flex justify-content-between">
        <?php if (isset($_SESSION['username'])): ?>
            <span class="me-2">User: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
            <a href="./logout.php" class="btn btn-sm btn-outline-danger mb-3">Logout</a>
        <?php else: ?>
            <a href="../create_blog_post.php" class="btn btn-success"> + Kreiraj novi post</a>
            <a href="../views/login.view.php" class="btn btn-sm btn-outline-primary">Login</a>
        <?php endif; ?>
    </section>


    <?php if (isset($posts) && count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h4><?= htmlspecialchars($post['title']) ?></h4>
                    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    <small class="text-muted">
                        Autor: <?= htmlspecialchars($post['username']) ?> |
                        Datum: <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
                    </small>

                    <!-- Provera da li je korisnik autor posta -->
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                        <div class="mt-2">
                            <a href="edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-warning">Izmeni</a>
                            <a href="./delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Da li sigurno želiš da obrišeš post?');">Obriši</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h4 class="text-center">Nema postova!</h4>
    <?php endif; ?>

    <?php include '../parts/bottom.php'; ?>