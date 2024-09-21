<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'moviebook';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}
?>
