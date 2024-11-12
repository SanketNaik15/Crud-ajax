<?php
include "connection.php";
$id = $_POST['id'];

$sql ="DELETE FROM users WHERE id = {$id}";


if (mysqli_query($conn, $sql)) {
    
    echo 1;
} else {
    
    echo 0;
}

mysqli_close($conn); 





?>