<?php
/*$server = "localhost";
$username = "root";
$password = "";
$database = "autoelektrobase1";*/
$server = "localhost";
$username = "autoelektrobase1";
$password = "Datomi041112.";
$database = "autoelektrobase1";
// Create connection
$dbconn = new mysqli($server, $username, $password, $database);
// Check connection
if ($dbconn->connect_error) {
  die("Connection failed: " . $dbconn->connect_error);
}
