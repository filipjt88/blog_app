<?php
$title = "Blog post";
include 'parts/top.php';
session_start();
// Provera da li je user logovan
if (!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}
?>

<div class="container mt-5">
    <h2 class="text-center">Novi blog post</h2>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form action="create_blog_process.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Naslov</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Kategorija</label>
            <select class="form-select" name="categories" aria-label="Default select example">
                <?php foreach($categories as $category): ?>
            <option selected>Open this select menu</option>
            <option value="<?php $_POST['category']; ?>">One</option>
            <?php endforeach; ?>
</select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Sadrzaj</label>
            <textarea name="content" id="content" rows="6" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Objavi</button>
        <a href="views/index.view.php" class="btn btn-secondary">Vrati se nazad</a>
    </form>
</div>
<?php include 'parts/bottom.php'; ?>