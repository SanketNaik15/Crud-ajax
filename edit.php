<?php
include "connection.php";

$id = $_POST['sid'];
$username = $_POST['username'];
$mobileno = $_POST['mobileno'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];

// Initialize a variable for the new image name
$newName = null;

// Check if a new file is uploaded
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $imageName = $_FILES['profile_image']['name'];
    $imageTmpName = $_FILES['profile_image']['tmp_name'];
    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
    $valid_extension = array("png", "jpeg", "jpg", "gif");

    if (in_array(strtolower($extension), $valid_extension)) {
        $newName = rand() . "." . $extension;
        $path = "Images/" . $newName;

        // Move the file to the Images directory
        if (move_uploaded_file($imageTmpName, $path)) {
            echo '<img src="' . $path . '" />';
        } else {
            echo '<script> alert("Error uploading the image!")</script>';
            exit;
        }
    } else {
        echo '<script> alert("Invalid file format")</script>';
        exit;
    }
}

// SQL query to update the user record

    $sql = "UPDATE users SET name='$username', mobileno='$mobileno', email='$email', date_of_birth='$birthday', 
            country='$country', state='$state', city='$city', img_name='$newName' WHERE id='$id'";


if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}

mysqli_close($conn);
?>
