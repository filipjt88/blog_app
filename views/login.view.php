<?php $title = 'Login'; ?>
<?php include '../parts/top.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-2 mt-5">
            <h1 class="text-center">Prijava</h1>
            <form id="loginForm" action="../login.php" method="POST">
                <input type="email" name="email" class="form-control" placeholder="Please enter email"><br>
                <input type="password" name="password" class="form-control" placeholder="Please enter the password"><br>
                <button type="submit" class="btn btn btn-success">Login</button>
            </form>
            <a href="register.view.php">Nemate nalog?Registrujte se odmah!</a>
            <?php if(isset($_GET['error'])): ?>
                <div class="alert alert-danger"><?php htmlspecialchars($_GET['error']) ?></div>
            <?php endif; ?>
            <?php if(isset($_GET['registered'])): ?>
                <div class="alert alert-success">Uspesno ste se registrovali! Prijavite se.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../parts/bottom.php'; ?>
