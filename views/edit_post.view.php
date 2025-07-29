<!-- Edit page -->
<?php
$title = 'Edit post';
require_once __DIR__ . '/../parts/top.php'; ?>

<div class="container mt-5">
    <?php require_once __DIR__ . '/../parts/navbar.php'; ?>
    <h2 class="text-center mt-5">Edit post</h2>
    <div class="row">
        <div class="col-md-6 offset-3">
             <?php if(isset($_GET['error'])): ?>
        <div class="alert aler-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    <form action="./edit_post_process.php" method="POST">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($post['title']) ?>">
        </div>
        <div class="mb-3">
            <img src="<?= htmlspecialchars($post['image']) ?>" alt="Slika posta" class="card-img-top img-thumbnail" style="height: auto; object-fit: cover;">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contents</label>
            <textarea name="content" id="content" rows="6" class="form-control"><?= htmlspecialchars($post['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Save changes</button>
        <a href="index.php" class="btn btn-outline-dark">Back to page</a>
    </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>
<!-- End of Edit page -->
