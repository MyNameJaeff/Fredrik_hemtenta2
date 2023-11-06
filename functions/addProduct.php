<?php
echo "
    <form method='POST' id='addForm' enctype='multipart/form-data'>
        <label for='name'>Name:</label>
        <input type='text' name='name' id='name' max='40' required>
        <label for='desc'>Description:</label>
        <input type='text' name='desc' id='desc' max='200' required>
        <label for='price'>Price:</label>
        <input type='text' name='price' id='price' max='100' required>
        <label for='img'>Image:</label>
        <input type='file' name='img' id='img' accept='image/*' required>
        <input type='submit' value='Submit' name='addSubmit'>
    </form>
    ";
?>