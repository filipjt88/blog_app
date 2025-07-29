<!-- Register page -->
<?php $title = 'Register'; ?>
<?php require_once __DIR__ . '/../parts/top.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
           <form id="registerForm" action="../register.php" method="POST" novalidate class="login-form">
                <h1>Register</h1>

                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Please enter username..." required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Please enter email..." required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Please enter the password..." required>

                <label for="password_confirm">Password repeat</label>
                <input type="password" id="password_confirm" name="password_confirm" placeholder="Please enter the password repeat..." required>

                <button type="submit">Register</button>
                <a href="login.view.php" class="register-link">Imate nalog? Prijavite se!</a>
                </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>
<!-- End of Register page -->