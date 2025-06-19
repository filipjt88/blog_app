<?php $title = "Izmeni nalog"; ?>
<?php require_once __DIR__ . '/../parts/top.php'; ?>

<?php var_dump($success); ?>

<div class="container">
    <?php include './parts/navbar.php'; ?>
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <h3 class="mb-4 text-center">Izmeni nalog</h3>

            <?php if(!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if(!empty($success)): ?>
                    <div class="alert alert-success"><?= htmlspecialchars($success) ?>
                </div>
                    <?php endif; ?>

                <form method="POST" class="mt-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" value ="<?= htmlspecialchars($user['username']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Nova lozinka: (ostavi prazno ako ne menjas!)</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Potvrdi lozinku:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sacuvaj izmene</button>
                </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../parts/bottom.php';  ?>
<?php require_once __DIR__ . '/../parts/footer.php'; ?>