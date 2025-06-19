<?php
session_start();
require_once 'core/db.php';
require_once 'core/init.php';

// Provera da li je korisnik ulogovan
if(!isset($_SESSION['user_id'])) {
    header("Location: ./views/login.view.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Dohvati trenutne podatke korisnika
$stmt = $pdo->prepare("SELECT * FROM users WHERE id =?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

$errors  = [];
$success = [];

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $new_username = trim($_POST['username']);
    $new_email    = trim($_POST['email']);
    $new_password = trim($_POST['confirm_password']);

    // Validacija
    if(empty($new_username) || empty($new_email)) {
        $errors = "Korisnicko ime i email su obavezni!";
    }

    if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors = "Email adresa nije validna!";
    }

    if(!empty($new_password)) {
        if(strlen($new_password) < 6) {
            $errors = 'Password mora imati minimum 6 karaktera!';
        } elseif($new_password !== $confirm_password) {
            $errors[] = 'Passwordi se ne poklapaju!';
        }
    }

    if(empty($errors)) {
        if(!empty($new_password)) {
            $hashPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute([$new_password, $new_email, $hashPassword, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, WHERE id = ?");
            $stmt->execute([$new_username,$new_email,$user_id]);
        }
        $_SESSION['username'] = $new_username; // Osvezi sesiju
        $success = 'Podaci su uspesno azurirani!';
        // Ponovo ucitaj azurirane podatke
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch();
    }
}

include 'views/change_account.view.php';
