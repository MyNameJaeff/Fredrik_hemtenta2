<?php
// Prints a form for sending data to the database for adding an item to it
// is its own file because i can call it multiple times easily
echo "
    <div id='form-div'>
        <form method='POST' id='addForm' enctype='multipart/form-data'>
            <div class='form-group'>
                <label for='name'>Name:</label>
                <input class='form-control' type='text' name='name' id='name' max='40' required>
            </div>
            <div class='form-group'>
            <label for='desc'>Description:</label>
            <input class='form-control' type='text' name='desc' id='desc' max='200' required>
            </div>
            <div class='form-group'>
                <label for='price'>Price:</label>
                <input class='form-control' type='number' name='price' id='price' max='1e10' min='1' required placeholder='Not 0!'>
            </div>
            <div class='form-group'>
                <label for='img'>Image:</label>
                <input class='form-control-file' type='file' name='img' id='img' accept='image/*' required>
            </div>
            <input type='submit' class='btn btn-primary' value='Submit' name='addSubmit'>
        </form>
    </div>
    ";
?>