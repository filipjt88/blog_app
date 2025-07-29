<?php
$title = "Blog post";
include_once 'core/db.php';
require_once __DIR__ . '/./parts/top.php';

// Provera da li je user logovan
if (!isset($_SESSION['user_id'])) {
    header("Location: views/login.view.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<div class="container mt-5 mb-5">
    <?php require_once __DIR__ . '/./parts/navbar.php'; ?>
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3 mt-5">
        <h2 class="text-center">New blog post</h2>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <form id="blogForm" action="create_blog_process.php" method="POST" enctype="multipart/form-data" class="login-form">
  
  <label for="title">Title</label>
  <input type="text" name="title" id="title" placeholder="Enter a title..." required>
  
  <label for="category">Choose a category:</label>
  <select name="category_id" id="category" class="form-control" required>
    <?php foreach ($categories as $cat): ?>
      <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
    <?php endforeach; ?>
  </select>
  
  <label for="image">Image</label>
  <input type="file" name="image" id="image" accept="image/*">
  
  <label for="content">Contents</label>
  <textarea name="content" id="content" class="form-control" rows="6" placeholder="Enter content..." required></textarea><br>
  <div class="form-buttons">
    <button type="submit">Publish</button><br><br>
    <a href="index.php" class="btn btn-secondary btn-back">Back to page</a>
  </div>
</form>
        </div>
    </div>
</div>


<?php include 'parts/bottom.php'; ?>
<?php require_once __DIR__ . '/parts/footer.php'; ?>