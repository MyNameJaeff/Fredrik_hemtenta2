<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Connect to bootstrap for styling purposes -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Welcome</title>
</head>

<body>
    <?php
    // Runs the php code for creating the table and database inside the sql server
    include("functions/createTable.php");
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" id="navLink" href="">CRUD App!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <button id="add" class="btn btn-outline-primary me-2">Lägg till produkt</button>
                </li>
                <li class="nav-item">
                    <button id="see" class="btn btn-outline-success me-2">Se alla produkter</button>
                </li>
                <li class="nav-item">
                    <button id="change" class="btn btn-outline-info me-2">Ändra pris/bild på produkt</button>
                </li>
                <li class="nav-item">
                    <button id="remove" class="btn btn-outline-warning me-2">Ta bort produkt</button>
                </li>
            </ul>
        </div>
    </nav>
    <nav class="navbar navbar-light bg-light">
    </nav>
    <main>
        <div id="placeToLoad">
            <?php
            // Used this for move_uploaded_file error due to insufficient permissions
            // error_reporting(E_ALL);
            // ini_set('display_errors', 'On'); 
            ?>

            <!-- Sends the php code if the form for adding products has been submitted -->
            <?php if (isset($_POST['addSubmit'])) : ?>
                <?php
                $price = $_POST['price'];
                $price = intval($price); // Checks if $price is an integer, if not returns 0
                if ($price != 0) { // Checks so that the integer check has not failed

                    // Defines all of the data sent through the form as variables
                    $name = $_POST['name'];
                    $desc = $_POST['desc'];
                    $fileName = $_FILES['img']['name'];
                    $temp_name = $_FILES['img']['tmp_name'];
                    $location = 'img/';
                    $fullName = $location . $fileName; // Creates variable for full image path

                    // Moves the sent image file from temp folder to the images folder
                    move_uploaded_file($temp_name, $fullName);

                    // Connects to the database
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $sql = "INSERT INTO `products`(`name`, `description`, `price`, `images`)
                        VALUES ('$name', '$desc', '$price', '$fullName')";

                    // If no problems with sending data to table, 
                    // refresh the page to clear the $_POST data
                    if ($conn->query($sql) === TRUE) {
                        $conn->close();
                        header("Location: index.php");
                    } else {
                        $conn->close();
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else { // If the integer check failed send an alert to the user
                    echo ("<script>alert('You have to use an actual number!! (not 0)');</script>");
                    //header("Location: index.php");
                }
                /* Wanted to remove the $_POST data with some kind of function, did not find anything that worked so went with header() instead */
                ?>
            <!-- Sends the PHP code if the remove form has been submitted -->
            <?php elseif (isset($_POST["removeSubmit"])) : ?>
                <?php
                // Connects to the database to remove an item
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $id = $_POST["remWhat"];
                $sql = "DELETE FROM products WHERE id=$id"; // Removes said item from the database by the id of the item
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    header("Location: index.php");
                } else {
                    $conn->close();
                    echo "Error deleting record: " . $conn->error;
                }
                ?>
            <!-- Sends the PHP code if the change form has been submitted -->
            <?php elseif (isset($_POST["changeSubmit"])) : ?>
                <?php
                // Conencts to the databse to change an item inside of it
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $id = $_POST["changeWhat"];
                if ($_FILES['image']['name'] != "") { // If there is an image inputted change the src of the img in the database
                    $fileName = $_FILES['image']['name'];
                    $temp_name = $_FILES['image']['tmp_name'];
                    $location = 'img/';
                    $fullName = $location . $fileName;
                    move_uploaded_file($temp_name, $fullName);
                    echo $fullName;
                    $sql = "UPDATE products SET images='$fullName' WHERE id=$id";
                    if (($conn->query($sql) === TRUE) && ($_POST["price"] == "")) { // If price does not have an input refresh the site to clear $_POST data
                        header("Location: index.php");
                        $conn->close();
                    } else {
                        echo "Error updating image: " . $conn->error;
                        $conn->close();
                    }
                }

                if ($_POST["price"] != "") { // If there is an input for price change, change the price inside the database
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    $price = $_POST["price"];
                    $sql = "UPDATE products SET price=$price WHERE id=$id";
                    if ($conn->query($sql) === TRUE) {
                        header("Location: index.php");
                        $conn->close();
                    } else {
                        $conn->close();
                        echo "Error updating price: " . $conn->error;
                    }
                }

                ?>
            <?php endif; ?>
        </div>
    </main>
    <script>
        const change = (element) => { // If a <tr> element inside the change table is pressed add the values of said table row to the form
            var arr = Array.prototype.slice.call( element.children )
            $('#changeWhat').val(arr[0].innerText);
            $('#price').val(arr[3].innerText);
        }
        const remove = (element) => {// If a <tr> element inside the remove table is pressed add the values of said table row to the form
            var arr = Array.prototype.slice.call( element.children )
            $('#remWhat').val(arr[0].innerText);
        }
    </script>
    <script src="js/script.js"></script>
</body>

</html>