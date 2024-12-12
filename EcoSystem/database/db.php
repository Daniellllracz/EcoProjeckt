<?php
$host = 'localhost';    // Az adatbázis szerver címe
$dbname = 'register';   // Az adatbázis neve
$username = 'root';     // Az adatbázis felhasználónév
$password = '';         // Az adatbázis jelszava (ha szükséges)

try {
    // Adatbázis kapcsolat létrehozása
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Hiba kezelés beállítása
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Hiba: " . $e->getMessage();
}
?>
