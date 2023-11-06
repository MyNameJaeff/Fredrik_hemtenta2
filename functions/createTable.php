<?php
$servername = "localhost";

$username = "root";

$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS crud_app";
if ($conn->query($sql) === TRUE) {
  echo "<script>console.log('Database created successfully');</script>";
} else {
  echo "Error creating database: " . $conn->error;
}
$conn->close();

$dbname = "crud_app";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT(50) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(40) NOT NULL,
    description VARCHAR(200) NOT NULL,
    price INT(100) NOT NULL,
    images VARCHAR(100) NOT NULL
    )";
if (!mysqli_query($conn, $sql)) {
    die("Error creating table: " . mysqli_error($conn));
}

if ($conn->connect_error) {
    die("Connection Failed" . $conn->connect_error);
}

$conn->close();
?>