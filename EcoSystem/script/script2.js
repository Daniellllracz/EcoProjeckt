const canvas = document.getElementById("game-canvas");
const ctx = canvas.getContext("2d");
const scoreDisplay = document.getElementById("score");
const energyBar = document.getElementById("energy-bar");
const gameOverScreen = document.getElementById("game-over");
const restartButton = document.getElementById("restart-button");
const startButton = document.getElementById("start-button");
const startScreen = document.getElementById("start-screen");

canvas.width = 600;
canvas.height = 800;

// Játék objektumok
let car = { x: 275, y: 700, width: 50, height: 100 };
let energy = 100;
let distance = 0;
let elements = [];
let gameOver = false;

startButton.addEventListener("click", () => {
    startScreen.style.display = "none"; // Start képernyő eltüntetése
    startGame(); // Játék indítása
});

// Képek betöltése
const carImage = new Image();
carImage.src = "../images/car.png"; // Az autó képe

const batteryImage = new Image();
batteryImage.src = "../images/battery.png"; // Az elem képe

const roadImage = new Image();
roadImage.src = "../images/road.png"; // Az út képe

// Út rajzolása
let roadOffsetY = 0;
function startGame() {
    // Játéklogika inicializálása
    energy = 100; // Energia visszaállítása
    distance = 0; // Távolság visszaállítása
    gameOver = false; // Játék állapot visszaállítása
    gameLoop(); // Fő játék ciklus indítása
}

function drawRoad() {
    // Fehér háttér rajzolása
    ctx.fillStyle = "green"; // Háttérszín zöld
    ctx.fillRect(0, 0, canvas.width, canvas.height); // Teljes canvas kitöltése

    // Út animáció
    roadOffsetY += 5; // Háttér mozgás sebessége
    if (roadOffsetY >= canvas.height) roadOffsetY = 0;

    // Első rész (felső rész mozgó kép)
    ctx.drawImage(roadImage, 0, roadOffsetY - canvas.height, canvas.width, canvas.height);

    // Második rész (folytatás alul)
    ctx.drawImage(roadImage, 0, roadOffsetY, canvas.width, canvas.height);
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
const roadWidth = canvas.width * 0.5; // Az út a canvas szélességének 50%-a
const roadLeft = (canvas.width - roadWidth) / 2;
const roadRight = roadLeft + roadWidth;

function updateElements() {
    elements.forEach(el => (el.y += 5));
    elements = elements.filter(el => el.y < canvas.height);

    // Elem spawnolása, csak az úttestre
    if (Math.random() < 0.02) {
        elements.push({
            x: Math.random() * (roadRight - roadLeft) + roadLeft,
            y: -30,
            width: 30,
            height: 30,
        });
    };
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

// Balra-jobbra mozgás figyelése
let carSpeed = 5; // Az autó sebessége (balra-jobbra)
document.addEventListener("keydown", (event) => {
    if (gameOver) return;

    if (event.key === "ArrowLeft" && car.x > roadLeft) {
        car.x -= carSpeed; // Balra mozgás
    } else if (event.key === "ArrowRight" && car.x + car.width < roadRight) {
        car.x += carSpeed; // Jobbra mozgás
    }
});

// Játék fő ciklusa
function gameLoop() {
    if (gameOver) return;

    // Canvas tisztítása
    ctx.clearRect(0, 0, canvas.width, canvas.height);

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
