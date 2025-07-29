<?php
include './core/db.php';
require_once __DIR__ . '/../parts/top.php';

$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll();
?>

<!-- Navbar -->
<?php require_once __DIR__ . '/../core/init.php'; ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold fs-3" href="index.php">
      <i class="fa-solid fa-feather-pointed text-primary me-2"></i>BlogApp
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#modernNavbar" aria-controls="modernNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="modernNavbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-semibold">
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="index.php" data-category="all">Naslovna</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="#" data-category="Biznis">Biznis</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="#" data-category="Zdravlje">Zdravlje</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="#" data-category="Tehnologija">Tehnologija</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="#" data-category="Sport">Sport</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="#" data-category="Automobili">Automobili</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 text-dark" href="#" data-category="Putovanja">Putovanja</a>
        </li>
      </ul>

      <div class="d-flex align-items-center gap-3">
        <a href="create_blog_post.php" class="btn btn-primary btn-sm rounded-pill px-4 fw-semibold shadow-sm">Kreiraj post</a>

        <div class="dropdown">
          <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://i.pravatar.cc/40" alt="User Avatar" class="rounded-circle me-2" width="40" height="40" />
            <span class="text-dark fw-semibold">
              <?php if(isset($_SESSION['username'])): ?>
                <?= htmlspecialchars($_SESSION['username']) ?>
              <?php else: ?>
                Moj nalog
              <?php endif; ?>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userMenu" style="min-width: 200px;">
            <?php if(isset($_SESSION['username'])): ?>
              <li><a class="dropdown-item" href="change_account.php">Izmena ličnih podataka</a></li>
              <li><a class="dropdown-item" href="#">Promeni email</a></li>
              <li><a class="dropdown-item" href="#">Promeni password</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="logout.php">Odjava</a></li>
            <?php else: ?>
              <li><a class="dropdown-item" href="login.view.php">Login</a></li>
              <li><a class="dropdown-item" href="register.view.php">Registracija</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- End of navbar -->