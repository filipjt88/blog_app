<?php $title = 'Login'; ?>
<?php require_once __DIR__ . '/../parts/top.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <form id="loginForm" action="../login.php" method="POST">
            <h1 class="text-center">Prijava</h1>
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Please enter email..."><br>
                <label for="email">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Please enter the password..."><br>
                <button type="submit" class="form-control btn btn-success">Login</button>
            </form>
            <a class="nav-link nav-link-form" href="register.view.php">Nemate nalog? Registrujte se!</a>
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger"><?php htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>
            <?php if(isset($_GET['registered'])): ?>
                <div class="alert alert-success">Uspesno ste se registrovali! Prijavite se.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>