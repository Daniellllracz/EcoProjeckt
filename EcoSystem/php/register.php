<?php
// Adatbázis kapcsolat
include('../database/db.php');

// Az űrlap adatainak ellenőrzése
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // A jelszó titkosítása
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Felhasználó adatainak beszúrása az adatbázisba
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $hashed_password]);

        // Ha sikerült, átirányítás a home.html oldalra
        header('Location: ../html/index.html');
        exit(); // Biztosítjuk, hogy a további kód ne fusson le
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}
?>
