<?php
// Adatbázis kapcsolat
include('../database/db.php');

// Munkamenet indítása
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        // Felhasználó lekérdezése az email alapján
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Ha az email és a jelszó egyeznek, bejelentkeztetjük a felhasználót
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ../html/home.html'); // Átirányítás a főoldalra
            exit();
        } else {
            // Hibaüzenet, ha az adatok nem egyeznek
            $error = "Hibás email vagy jelszó!";
        }
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
}
?>
