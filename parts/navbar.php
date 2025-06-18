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
      <ul id='category-filter' class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" data-category='all' aria-current="page" href="./index.php">Naslovna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-category='Biznis' href="javascript:void(0);">| Biznis |</a>
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
          <a href="./create_blog_post.php" class="nav-link">Kreiraj post</a>
        </li>
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
              Moj nalog
</a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <li><a href="#" class="dropdown-item">Izmena licnih podataka</a></li>
              <li><a class="dropdown-item">Promeni email</a></li>
              <li><a class="dropdown-item">Promeni password</a></li>
            </ul>
          </div>
          <li class="nav-item">
          <?php if(isset($_SESSION['username'])): ?>
          <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-user"></i> <?= htmlspecialchars($_SESSION['username']) ?></a>
        </li>
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