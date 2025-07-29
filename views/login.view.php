<!--  Login page -->
<?php $title = 'Login'; ?>
<?php require_once __DIR__ . '/../parts/top.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="login-wrapper">
  <form id="loginForm" action="../login.php" method="POST" class="login-form">
        <h1>LogIn</h1>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Please enter email..." required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Please enter the password..." required>

    <button type="submit">Login</button>
    <a class="register-link" href="register.view.php">Don't have an account? Register!</a>

    <?php if(isset($_GET['error'])): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <?php if(isset($_GET['registered'])): ?>
      <div class="alert alert-success">Uspešno ste se registrovali! Prijavite se.</div>
    <?php endif; ?>
  </form>
</div>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>
<!--  End of Login page -->