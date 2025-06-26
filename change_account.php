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

$errors  = [];
$success = "";

// Ucitaj trenutne podatke korisnika
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


if($_SERVER['REQUEST_METHOD'] === "POST") {
    $new_username = trim($_POST['username'] ?? '');
    $new_email    = trim($_POST['email'] ?? '');
    $new_password = $_POST['confirm_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validacija
    if(empty($new_username) || empty($new_email)) {
        $errors[] = "Korisnicko ime i email su obavezni!";
    }

    if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email adresa nije validna!";
    }

    $updatePassword = false;

    if(!empty($new_password)) {
        if(strlen($new_password) < 6) {
            $errors[] = 'Password mora imati minimum 6 karaktera!';
        } elseif ($new_password !== $confirm_password) {
            $errors[] = 'Passwordi se ne poklapaju!';
        } else {
            $updatePassword = true;
        }
    }

    // Provera da li je email zauzet u bazi
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$new_email,$user_id]);
    $existingEmail = $stmt->fetch();
    if($existingEmail) {
        $errors[] = "Navedena email adresa vec postoji!";
    }

    // Provera da li je username zauzet u bazi
    $stmt = $pdo->prepare("SELECT username FROM users WHERE username = ? AND id != ?");
    $stmt->execute([$new_username,$user_id]);
    $existingUsername = $stmt->fetch();
    if($existingUsername) {
        $errors[] = "Korisnicko ime vec postoji!";
    }

    if(empty($errors)) {
        if($updatePassword) {
            $hashPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute([$new_username, $new_email, $hashPassword, $user_id]);
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, WHERE id = ?");
            $stmt->execute([$new_username, $new_email, $user_id]);
        }
        $_SESSION['username'] = $new_username; // Osvezi sesiju
        $success = 'Podaci su uspesno azurirani!';
        header("Location: index.php");
        
        // Ponovo ucitaj azurirane podatke
        $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

include 'views/change_account.view.php';
