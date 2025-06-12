<?php
include './core/db.php';
require_once __DIR__ . '/../parts/top.php';

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<?php require_once __DIR__ . '/../core/init.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Blog app |</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" data-category='all' aria-current="page" href="#">Naslovna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Biznis' href="#">| Biznis |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Zdravlje' href="#"> Zdravlje |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Tehnologija' href="#">Tehnologija |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Sport' href="#">Sport |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Automobili' href="#">Automobili |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Putovanja' href="#">Putovanja |</a>
        </li>
      </ul>
    </div>
     <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
    <li class="nav-item">
          <?php if(isset($_SESSION['username'])): ?>
          <a class="nav-link active" aria-current="page" href="#">User: <?= htmlspecialchars($_SESSION['username']) ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Moj nalog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./logout.php">Odjava</a>
        </li>
        <?php else: ?>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../views/login.view.php">Login</a>
        </li>
        <?php endif; ?>
        </ul>
  </div>
</nav>