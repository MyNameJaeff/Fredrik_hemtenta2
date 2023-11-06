<?php
$servername = "localhost";

$username = "root";

$password = "";

$dbname = "crud_app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

echo ("<div class='container'>");
$table = "<ul class=''>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table .= "<li><p>" . "ID: " . $row['id'] . ", Name: " . $row['name'] . ", Desc: " . $row['description'] . ", Price: " . $row['price'] . ", Img: <img class='li_img' src='" . $row['images'] . "'>" . "</p></li>";
    }
    $table .= "</ul>";
    echo $table;
} else {
    echo "0 results";
}
echo ("</div>");
$conn->close();
?>