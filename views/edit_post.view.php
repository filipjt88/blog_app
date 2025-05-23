<?php include 'parts/top.php'; ?>


<div class="container mt-5">
    <h2 class="text-center">Izmena posta</h2>
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
            <label for="content" class="form-label">Sadrzaj</label>
            <textarea name="content" id="content" rows="6" class="form-control"><?= htmlspecialchars($post['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Sacuvaj izmene</button>
        <a href="./index.view.php" class="btn btn-secondary">Vrati se nazad</a>
    </form>
</div>

<?php include 'parts/bottom.php'; ?>
