<?php
/* Connects to the server for changing products */
$servername = "localhost";

$username = "root";

$password = "";

$dbname = "crud_app";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM products"; // Selects every row inside the database for printing
$result = $conn->query($sql);
// prints a form for changing image/price which then sends it to the index file with what to change
echo ("<div class='form-div'>
<form method='POST' enctype='multipart/form-data'>
    <div class='form-group'>
        <label for='changeWhat'>Change ID:</label>
        <input class='form-control' type='text' id='changeWhat' name='changeWhat' required>
    </div>
    <div class='form-group'>
        <label for='price'>Price:</label>
        <input class='form-control' type='text' id='price' name='price'>
    </div>
    <div class='form-group'>
        <label for='image'>Image:</label>
        <input class='form-control' type='file' id='image' name='image' accept='image/' >
    </div>
    <input type='submit' class='btn btn-primary' value='Submit' name='changeSubmit'>
</form>
</div>");

echo ("<div class='container'>");

// Checks if the amount of rows in the database is more than none, if not prints out "0 results"
if ($result->num_rows > 0) {
    $table = "<table id='changeTable' class='table table-hover'><caption>List of Products</caption>";
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

    // goes through all rows in the database and adds them to the $table element for later printing
    while ($row = $result->fetch_assoc()) {
        $table .= "<tr onclick='change(this)'>
                    <th scope='row'>" . $row['id'] . "</th>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td><img class='li_img' src='" . $row['images'] . "'>" . "</td>
                    </tr>";
    }
    $table .= "</tbody></table>";
    // prints the list of elements
    echo $table;
} else {
    echo "0 results";
}
echo ("</div>");
// Always close the connection to the database as a security measure
$conn->close();
