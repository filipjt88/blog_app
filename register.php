<?php 
include 'core/db.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
    // Prikupljanje podataka preko forme
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_confirm = trim($_POST['password_confirm']);

    // Provera da li su sva polja popunjena
    if(empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        die("Sva polja su obavezna!🙂");
    }

    // Provera da li se gadjaju passowrd i pasword confirm poklapaju
    if($password !== $password_confirm) {
        die("Lozinke se ne poklapaju, pokusajte ponovo!🙂");
    }

    // Provera da li vec korisnik postoji u bazi podataka
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
    $stmt->execute(['email' => $email, 'username' => $username]);
    if($stmt->fetch()) {
        die("Korisnik sa tim emailom vec postoji u nasoj bazi podataka!🙂");
    }

    // Heshiranje lozinke
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    // Registracija u bazi
    $insert = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    $insert->execute([
        'username' => $username,
        'email'    => $email,
        'password' => $hashPassword
    ]);

    // Preusmeravanje na drugu stranicu
    header("Location: login.php?registered=1");
    exit;
} else {
    die("Ovo je nevazeci zahtev!");
}

?>
