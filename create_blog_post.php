<?php
$title = "Blog post";
include_once 'core/db.php';
require_once __DIR__ . '/./parts/top.php';
session_start();

// Provera da li je user logovan
if (!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7 offset-2 mt-5">
        <h2 class="text-center">Novi blog post</h2>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form id="blogForm" action="create_blog_process.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Izaberi kategoriju:</label>
            <select class="form-select" name="category_id" aria-label="Default select example" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Slika</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Sadrzaj</label>
            <textarea name="content" id="content" rows="6" class="form-control"></textarea>
        </div>
        <a href="index.php" class="btn btn-secondary">Vrati se nazad</a>
        <button type="submit" class="btn btn-success">Objavi</button>
    </form>
        </div>
    </div>
</div>
<?php include 'parts/bottom.php'; ?>