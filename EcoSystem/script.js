// script.js
const canvas = document.getElementById("game-canvas");
const ctx = canvas.getContext("2d");
const scoreDisplay = document.getElementById("score");
const energyBar = document.getElementById("energy-bar");
const gameOverScreen = document.getElementById("game-over");
const restartButton = document.getElementById("restart-button");

canvas.width = 600;
canvas.height = 800;

// Játék objektumok
let car = { x: 275, y: 700, width: 50, height: 100 };
let energy = 100;
let distance = 0;
let elements = [];
let gameOver = false;

// Képek betöltése
const carImage = new Image();
carImage.src = "../EcoSystem/images/car.png"; // Az autó képe

const batteryImage = new Image();
batteryImage.src = "../EcoSystem/images/battery.png"; // Az elem képe

const roadImage = new Image();
roadImage.src = "../EcoSystem/images/road.jpg"; // Az út képe

// Út rajzolása
function drawRoad() {
    ctx.drawImage(roadImage, 0, 0, canvas.width, canvas.height);
}

// Autó rajzolása
function drawCar() {
    ctx.drawImage(carImage, car.x, car.y, car.width, car.height);
}

// Elem rajzolása
function drawElements() {
    elements.forEach(el => {
        ctx.drawImage(batteryImage, el.x, el.y, el.width, el.height);
    });
}

// Elemmek mozgása
function updateElements() {
    elements.forEach(el => (el.y += 5));
    elements = elements.filter(el => el.y < canvas.height);
    if (Math.random() < 0.02) {
        elements.push({
            x: Math.random() * (canvas.width - 30),
            y: -30,
            width: 30,
            height: 30,
        });
    }
}

// Ütközés ellenőrzése
function checkCollision() {
    elements.forEach((el, index) => {
        if (
            car.x < el.x + el.width &&
            car.x + car.width > el.x &&
            car.y < el.y + el.height &&
            car.height + car.y > el.y
        ) {
            elements.splice(index, 1);
            energy = Math.min(100, energy + 20);
        }
    });
}

// Játék vége
function endGame() {
    gameOver = true;
    gameOverScreen.style.display = "block";
}

// Játék újraindítása
restartButton.addEventListener("click", () => {
    gameOver = false;
    gameOverScreen.style.display = "none";
    car.x = 275;
    car.y = 700;
    energy = 100;
    distance = 0;
    elements = [];
    gameLoop();
});

// Játék fő ciklusa
function gameLoop() {
    if (gameOver) return;

    // Háttér rajzolása
    drawRoad();

    // Autó, elemek és mozgás
    drawCar();
    drawElements();
    updateElements();
    checkCollision();

    // Energiacsík és távolság frissítése
    energy -= 0.1;
    if (energy <= 0) {
        endGame();
    }
    energyBar.style.width = `${energy}%`;
    distance += 0.05;
    scoreDisplay.textContent = `Távolság: ${Math.floor(distance)} km`;

    // Újramegjelenítés
    requestAnimationFrame(gameLoop);
}

// Képek betöltése után kezdődik a játék
roadImage.onload = () => {
    carImage.onload = () => {
        batteryImage.onload = () => {
            gameLoop();
        };
    };
};

// Autó irányítása
window.addEventListener("keydown", (e) => {
    if (e.key === "ArrowLeft" && car.x > 0) {
        car.x -= 10;
    } else if (e.key === "ArrowRight" && car.x < canvas.width - car.width) {
        car.x += 10;
    }
});
