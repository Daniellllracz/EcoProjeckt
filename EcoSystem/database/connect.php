<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "eco";

// Create connection
$dbconn = new mysqli($server, $username, $password, $database);
// Check connection
if ($dbconn->connect_error) {
  die("Connection failed: " . $dbconn->connect_error);
}
