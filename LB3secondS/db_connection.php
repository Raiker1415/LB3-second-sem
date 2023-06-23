<?php
$host = 'localhost';
$dbName = 'lb_pdo_netstat';
$username = 'root';
$password = '';

try {
    // Підключення до бази даних
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Помилка підключення до бази даних: ' . $e->getMessage();
    die();
}
?>