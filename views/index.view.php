<?php include '../parts/top.php'; ?>

<div class="container mt-5">
        <h2 class="text-center">Svi postovi</h2>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <?php if (isset($_SESSION['user_username'])): ?>
                <span class="me-2">Ulogovan kao: <strong><?= htmlspecialchars($_SESSION['user_username']) ?></strong></span>
                <a href="../actions/logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
            <?php else: ?>
                <a href="login.view.php" class="btn btn-sm btn-outline-primary">Login</a>
            <?php endif; ?>
        </div>
    </div>

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
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                        <div class="mt-2">
                            <a href="../edit_post.php?= $post['id'] ?>" class="btn btn-sm btn-warning">Izmeni</a>
                            <a href="./delete_post.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Da li sigurno želiš da obrišeš post?');">Obriši</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nema postova za prikaz.</p>
    <?php endif; ?>
</div>

<?php include '../parts/bottom.php'; ?>
