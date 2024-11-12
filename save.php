<?php
include "connection.php";
if(isset($_FILES['file']) ){
    $filename= $_FILES['file']['name'];
    $temp_name= $_FILES['file']['tmp_name'];
    
    
    $extension =pathinfo($filename,PATHINFO_EXTENSION);
    $valied_extension =array("png","jpeg","jpg","gif");
    
    if (in_array($extension,$valied_extension)){
        $newName=rand() . "." . $extension;
        $path="Images/". $newName;
        if(move_uploaded_file($temp_name,$path)){
            echo '<img src="'.$path.'"/>';
    
     
            
        }
    }else{
        echo '<script> alert("Invalied  file format")</script>';
    }
    
   

$u_name = $_POST['name'];
$u_email = $_POST['email'];
$u_mobileno = $_POST['mobileno'];
$u_dob = $_POST['dob'];  
$u_country = $_POST['country'];
$u_state = $_POST['state'];
$u_city = $_POST['city'];

$sql = "INSERT INTO users (name, email, mobileno, date_of_birth, country, state, city,img_name)
        VALUES ('{$u_name}', '{$u_email}', '{$u_mobileno}', '{$u_dob}', '{$u_country}', '{$u_state}', '{$u_city}','{$newName}')";

if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
}
mysqli_close($conn); 
?>
