<?php include '../parts/top.php'; ?>
<?php include '../parts/navbar.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-3 mt-5">
            <h1 class="text-center">Register</h1>
            <form action="register.php" method="POST">
                <input type="text" name="first_name" class="form-control" placeholder="Please enter first name"><br>
                <input type="text" name="last_name" class="form-control" placeholder="Please enter last name"><br>
                <input type="email" name="email" class="form-control" placeholder="Please enter email"><br>
                <input type="password" name="password" class="form-control" placeholder="Please enter the password"><br>
                <input type="password" name="password_confirm" class="form-control" placeholder="Please enter the password repeat"><br>
                <button type="submit" class="btn btn btn-success">Register</button>
            </form>
        </div>
    </div>
</div>

<?php include '../parts/bottom.php'; ?>
