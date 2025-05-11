<!-- Database -->
<?php

$host = 'localhost';
$db   = 'blog_app';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;$dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // hvatanje gresaka
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // pristup rezultatima kao asocijativni niz
    PDO::ATTR_EMULATE_PREPARES   => false, // prava priprema upita
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch(\PDOException $e) {
    die('Konekcija sa bazom je neuspesna!' . $e->getMessage());
}

?>