<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <title>Welcome</title>
</head>

<body>
    <?php
    include("functions/createTable.php");
    ?>
    <h1>CRUD App!</h1>
    <nav>
        <button id="add">Lägg till produkt</button>
        <button id="see">Se alla produkter</button>
        <button id="change">Ändra pris/bild på produkt</button>
        <button id="remove">Ta bort produkt</button>
    </nav>
    <main>
        <div id="placeToLoad">
            <?php if (isset($_POST['addSubmit'])): ?>
                <?php
                $fileName = $_FILES['img']['name'];
                $temp_name = $_FILES['img']['tmp_name'];
                $location = 'img/';
                $fullName = $location . $fileName;
                move_uploaded_file($temp_name, $fullName);
                $conn = new mysqli($servername, $username, $password, $dbname);
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $price = $_POST['price'];
                $sql = "INSERT INTO `products`(`name`, `description`, `price`, `images`)
                        VALUES ('$name', '$desc', '$price', '$fullName')";
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    header("Location: index.php");
                } else {
                    $conn->close();
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                /* Ville ta bort möjlighet att skapa dubletter genom refresh, funkade inte så gick med header*/
                ?>
            <?php elseif (isset($_POST["removeSubmit"])): ?>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $id = $_POST["remWhat"];
                $sql = "DELETE FROM products WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    $conn->close();
                    header("Location: index.php");
                } else {
                    $conn->close();
                    echo "Error deleting record: " . $conn->error;
                }
                ?>
            <?php elseif (isset($_POST["changeSubmit"])): ?>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $id = $_POST["changeWhat"];
                if ($_FILES['image']['name'] != "") {
                    $fileName = $_FILES['image']['name'];
                    $temp_name = $_FILES['image']['tmp_name'];
                    $location = 'img/';
                    $fullName = $location . $fileName;
                    move_uploaded_file($temp_name, $fullName);
                    echo $fullName;
                    $sql = "UPDATE products SET images='$fullName' WHERE id=$id";
                    if (($conn->query($sql) === TRUE) && ($_POST["price"] == "")) {
                        header("Location: index.php");
                        $conn->close();
                    } else {
                        echo "Error updating image: " . $conn->error;
                        $conn->close();
                    }
                }

                if ($_POST["price"] != "") {
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
    <script src="js/script.js"></script>
</body>

</html>