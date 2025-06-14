<?php $title = 'Register'; ?>
<?php require_once __DIR__ . '/../parts/top.php'; ?>


<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3">
            <form id="registerForm" action="../register.php" method="POST" novalidate>
                <h1 class="text-center">Register</h1>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Please enter username..."><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Please enter email..."><br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Please enter the password..."><br>
                <label for="password_confirm">Password repeat:</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Please enter the password repeat..."><br>
                <button type="submit" class="btn btn btn-success form-control">Register</button>
            </form>
            <a href="login.view.php" class="nav-link nav-link-form">Imate nalog? Prijavite se!</a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php'; ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>