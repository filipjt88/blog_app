<?php 
session_start();
require_once('core/db.php');

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
// Provera email i passworda koja ne smeju biti prazna za unos
    if(empty($email) || empty($password)) {
        header("Location: login.php?error=" . urlencode("Sva polja su obavezna"));
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if(!$user || !password_verify($password, $user['password'])) {
        header("Location: login.php?error=" .urlencode("Pogresan email ili lozinka 😒!"));
        exit;
    }

    // Cuvanje podatka usera u sesiji
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // Preusmerenje usera na pocetnu stranicu
    header("Location: index.php");
}
?>
