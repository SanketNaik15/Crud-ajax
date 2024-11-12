<?php
if(isset($_POST['c_id']) && is_numeric($_POST['c_id'])){
    include "connection.php";
    $c_id = $_POST['c_id'];
    $sql = "SELECT * FROM states WHERE c_id = $c_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<option selected='selected'>Select State</option>";
        while($rows = mysqli_fetch_assoc($result)){
            echo '<option value="' . $rows['s_id'] . '">' . $rows['s_name'] . '</option>';
        }
    } else {
        echo "<option>No states found</option>";
    }
} 

if(isset($_POST['s_id']) && is_numeric($_POST['s_id'])){
    include "connection.php";
    $s_id = $_POST['s_id'];
    $sql1 = "SELECT * FROM cities WHERE s_id = $s_id";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        echo "<option selected='selected'>Select City</option>";
        while($rows1 = mysqli_fetch_assoc($result1)){
            echo '<option value="' . $rows1['ci_id'] . '">' . $rows1['ci_name'] . '</option>';
        }
    } else {
        echo "<option>No cities found</option>";
    }
}

?>