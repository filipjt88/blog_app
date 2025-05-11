<?php $title = 'Register'; ?>
<?php include '../parts/top.php'; ?>
<?php include '../parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <h1 class="text-center">Registracija</h1>
            <form id="registerForm" action="../register.php" method="POST" novalidate>
                <input type="text" id="username" name="username" class="form-control" placeholder="Please enter username"><br>
                <input type="email" id="email" name="email" class="form-control" placeholder="Please enter email"><br>
                <input type="password" id="password" name="password" class="form-control" placeholder="Please enter the password"><br>
                <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Please enter the password repeat"><br>
                <button type="submit" class="btn btn btn-success">Registruj se</button>
            </form>
        </div>
    </div>
</div>

<?php include '../parts/bottom.php'; ?>
