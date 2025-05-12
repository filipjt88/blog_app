<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center mt-5">Blog postovi</h1>
        <section>
            <strong><?php htmlspecialchars($_SESSION['username']) ?></strong> |
            <a href="./logout.php" class="btn btn-sm btn-outline-secondary">Logout</a>
        </section>
    </div>
</div>

<?php if(count($posts) === 0):  ?>
    <h3 class="text-center mt-5">Jos uvek nema blog postova :-(</h3>
    <?php else: ?>
    <?php foreach ($posts as $post):  ?>
        <div class="card mb-3">
            <div class="card-body">
                <h3 class="card-title"><?php htmlspecialchars($post['title']) ?></h3>
                <p class="card-text"><?php nl2br(htmlspecialchars($post['content'])) ?></p>
                <small class="text-muted">
                    Autor: <?php htmlspecialchars($post['username']) ?? 'Nepoznat' ?> |
                    Objavljeno : <?php date('d.m.Y. H:i', strtotime($post['created_at'])) ?>
                </small>
            </div>
        </div>
    <?php endforeach; ?>
    <?php endif; ?>