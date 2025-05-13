<div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center mt-5">Blog postovi</h1>
        <section>
            <a href="create_blog_post.php" class="btn btn-sm btn-success me-2">+ Dodaj novi post</a>
            <strong><?= htmlspecialchars($_SESSION['username']) ?></strong> |
            <a href="./logout.php" class="btn btn-sm btn-outline-secondary">Logout</a>
        </section>
    </div>
</div>

    <div class="container">
        <div class="row">
            <div class="col-md-9 offset-1">
                <?php if(count($posts) === 0):  ?>
    <h3 class="text-center mt-5">Jos uvek nema blog postova :-(</h3>
    <?php else: ?>
    <?php foreach ($posts as $post):  ?>
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title"><?= htmlspecialchars($post['title']) ?></h3>
                <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <small class="text-muted">
                    Autor: <?= htmlspecialchars($post['username']) ?? 'Nepoznat' ?> |
                    Objavljeno : <?= date('d.m.Y. H:i', strtotime($post['created_at'])) ?>
                </small>
                <?php if($_SESSION['user_id'] == $post['user_id']): ?>
                    <div class="mt-2">
                        <a href="edit_post.php?id=<?=$post['id'] ?>" class="btn btn-sm btn-warning">Izmeni</a>
                        <a href="delete_post.php?id=<?=$post['id'] ?>" class="btn btn-sm btn-danger">Obrisi</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>
            </div>
        </div>
    </div>