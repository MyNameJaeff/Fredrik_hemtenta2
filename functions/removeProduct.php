<?php
// Connects to the database for removing items
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

// Prints the form for removing a product from the database by ID
echo ("<div class='form-div'>
        <form method='POST'>
        <div class='form-group'>
            <label for='remWhat'>Remove ID:</label>
            <input type='text' class='form-control' id='remWhat' name='remWhat'>
        </div>
        <input class='btn btn-primary' type='submit' value='Submit' name='removeSubmit'>
        </form>
    </div>");
echo ("<div class='container'>");
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
// Checks if the amount of rows in the database is more than none, if not prints message
if ($result->num_rows > 0) {
    // Prints out a form for chosing what row to remove by entering the ID of it
    // Fetches each row in the database and adds the data to the $table variable for later printing
    while ($row = $result->fetch_assoc()) {
        $table .= "<tr onclick='remove(this)'>
                    <th scope='row'>" . $row['id'] . "</th>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['description'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td><img class='li_img' src='" . $row['images'] . "'>" . "</td>
                    </tr>";
    }
    $table .= "</tbody></table>";
    // Prints said variable as a list
    echo $table;
} else {
    echo "0 results";
}
echo ("</div>");

// Always close the connection to the database as a security measure
$conn->close();
?>