<?php
if (!isset($posts)) die('Nema direktnog pristupa.');
include './core/db.php';
require_once __DIR__ . '/../parts/top.php';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog app</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Pocetna strancia</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kategorije
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <?php foreach($categories as $cat): ?>
            <li><a class="dropdown-item" href="#"><?= htmlspecialchars($post['category_name']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./create_blog_post.php">Kreiraj novi post</a>
        </li>
        <li class="nav-item">
          <?php if(isset($_SESSION['username'])): ?>
          <a class="nav-link active" aria-current="page" href="#">User: <?= htmlspecialchars($_SESSION['username']) ?></a>
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
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>