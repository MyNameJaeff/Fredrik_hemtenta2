<?php
// Connects to the database for printing all items in it
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

echo ("<div class='all-products'>");
$table = "<table class='table table-hover'><caption>List of Products</caption>";
$table .= "
<thead class='thead-light'>
<tr>
<th scope='col'>ID</th>
<th scope='col'>Name</th>
<th scope='col'>Description</th>
<th scope='col'>Price</th>
<th scope='col'>Image</th>
</tr>
</thead><tbody>
";

if ($result->num_rows > 0) {
    // For each row in the database it adds the data to the $table variable for later printing
    while ($row = $result->fetch_assoc()) {
        $table .= "<tr>
                    <th scope='row'>" . $row['id'] . "</th>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td><img class='li_img' src='" . $row['images'] . "'>" . "</td>
                    </tr>";
    }
    $table .= "</tbody></table>";
    // Prints said $table variable as a list
    echo $table;
} else {
    echo "0 results";
}
echo ("</div>");

// Always close the connection to the database as a security measure
$conn->close();
?>