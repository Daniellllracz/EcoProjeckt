<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "autoelektrobase1";

// Create connection
$dbconn = new mysqli($server, $username, $password, $database);
// Check connection
if ($dbconn->connect_error) {
  die("Connection failed: " . $dbconn->connect_error);
}
