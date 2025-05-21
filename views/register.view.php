<?php $title = 'Register'; ?>
<?php include '../parts/top.php'; ?>


<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <form id="registerForm" action="../register.php" method="POST" novalidate>
                <h1 class="text-center">Registracija</h1>
                <label for="username">Korisnicko ime:</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Please enter username..."><br>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Please enter email..."><br>
                <label for="password">Lozinka:</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Please enter the password..."><br>
                <label for="password_confirm">Ponovi lozinku:</label>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Please enter the password repeat..."><br>
                <button type="submit" class="btn btn btn-success form-control">Registruj se</button>
            </form>
            <a href="login.view.php" class="nav-link nav-link-form">Imate nalog? Prijavite se!</a>
        </div>
    </div>
</div>

<?php include '../parts/bottom.php'; ?>
