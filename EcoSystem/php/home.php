<?php
include('../database/connect.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}
// Query to fetch some stats for the home page
$statsQuery = "SELECT COUNT(*) as total_users FROM Users";
$result = $conn->query($statsQuery);
$row = $result->fetch_assoc();
$total_users = $row['total_users'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../images/favicon.ico">
    <title>Home</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href='../php/home.php'>Home</a></li>
            <li><a href='../php/about.php'>About</a></li>
            <li><a href='../php/contact.php'>Contact</a></li>
        </ul>
    </nav>
    <section>
        <h1>Welcome to Eco Mobility!</h1>
        <p>Join our <strong><?php echo $total_users; ?></strong> registered users in making sustainable transportation choices.</p>
    </section>
    <main>
        <h1>Welcome to the Sustainable Transportation System</h1>
        <p>This platform aims to promote sustainability in the transportation sector by integrating public transportation, electric vehicle infrastructure, and bike-sharing systems.</p>
        <p>Explore more about our services and how they contribute to reducing emissions and energy consumption.</p>
    </main>
</body>
</html>
