-- Adatbázis létrehozása
CREATE DATABASE regisztracio;

-- Adatbázis használata
USE regisztracio;

-- Felhasználók tábla létrehozása
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,         -- Egyedi azonosító (ID)
    username VARCHAR(50) NOT NULL UNIQUE,       -- Felhasználónév
    email VARCHAR(100) NOT NULL UNIQUE,         -- Email cím
    password VARCHAR(255) NOT NULL,             -- Jelszó (titkosítva tárolva)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Regisztráció dátuma
);
