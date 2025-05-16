<?php include '../parts/top.php'; ?>
 <?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location:login.view.php");
    exit;
}
?>
<div class="container mt-5">
    <h2 class="text-center">Svi postovi</h2>
    <section class="d-flex justify-content-between">
        <?php if (isset($_SESSION['username'])): ?>
            <span class="me-2">User: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
            <a href="../logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
        <?php else: ?>
            <a href="../create_blog_post.php" class="btn btn-success"> + Kreiraj novi post</a>
            <a href="../views/login.view.php" class="btn btn-sm btn-outline-primary">Login</a>
        <?php endif; ?>
    </section>

    <?php if (isset($posts) && count($posts) > 0): ?>
        <?php foreach ($posts as $post): ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4><?= htmlspecialchars($post['title']) ?></h4>
                            <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                            <small class="text-muted">
                                Autor: <?= htmlspecialchars($post['username']) ?> |
                                Datum: <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
                            </small>
                            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                                <div class="mt-2">
                                    <a href="../edit_post.php?= $post['id'] ?>" class="btn btn-sm btn-warning">Izmeni</a>
                                    <a href="./delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Da li sigurno želiš da obrišeš post?');">Obriši</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <section>
                        <div class="row">
                            <div class="col-md-6 offset-5">
                                <h4>Nema postova za prikaz.</h4>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>
                    </div>
                </div>
            </div>
</div>
<?php include '../parts/bottom.php'; ?>