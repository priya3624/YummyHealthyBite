<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "food_recipe_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
