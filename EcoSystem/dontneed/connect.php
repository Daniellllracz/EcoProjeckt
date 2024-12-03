<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "eco";

// Adatbázis kapcsolat létrehozása
$conn = new mysqli($server, $username, $password, $database);

// Kapcsolódási hiba ellenőrzése
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];  // Helyesen megadott mezőnév
    $confirmPassword = $_POST['confirm-password'];

    // Jelszavak egyezésének ellenőrzése
    if ($password === $confirmPassword) {
        // Jelszó titkosítása biztonsági okokból
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Ellenőrzés: Létezik-e már a felhasználó
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Ha nincs ilyen felhasználó, új hozzáadása
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);
            $stmt->execute();

            echo "Registration successful!";
        } else {
            echo "User with this email already exists.";
        }
    } else {
        echo "Passwords do not match.";
    }
}

$conn->close();
?>
