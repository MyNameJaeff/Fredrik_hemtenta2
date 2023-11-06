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
    echo ("<form method='POST'><label for='remWhat'>Remove ID:</label><input type='text' id='remWhat' name='remWhat'><input type='submit' value='Submit' name='removeSubmit'></form>");
} else {
    echo "0 results";
}
echo ("</div>");
$conn->close();
?>