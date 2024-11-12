<?php
include "connection.php";

$sql = "SELECT users.id, users.name, users.email, users.mobileno, users.date_of_birth, users.img_name, 
                 countries.c_name, states.s_name, cities.ci_name 
          FROM users
          JOIN countries ON users.country = countries.c_id
          JOIN states ON users.state = states.s_id
          JOIN cities ON users.city = cities.ci_id ORDER BY id" ;

$result = mysqli_query($conn,$sql);
$output ="";
if(mysqli_num_rows($result) > 0){
    $output='<table class="table" id="table-data" border=1px >
    <thead>
    <tr>
    <th colspan=9><button type="button" class="add-btn">Add New Records</button>
    </th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">Img</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobileno</th>
      <th scope="col">Date of birth</th>
      <th scope="col">Contry</th>
      <th scope="col">State</th>
      <th scope="col">City</th>
      <th scope="col" colspan=2>Action</th>
    </tr>
  </thead>';

  while($row = mysqli_fetch_assoc($result)){
    $output.="
    <tbody>
    <tr>
      <th>{$row["id"]}</th>
      <th><img src='./Images/{$row["img_name"]}' width='40' height='40'></th>
      <td>{$row["name"]}</td>
      <td>{$row["email"]}</td>
      <td>{$row["mobileno"]}</td>
      <td>{$row["date_of_birth"]}</td>
      <td>{$row["c_name"]}</td>
      <td>{$row["s_name"]}</td>
      <td>{$row["ci_name"]}</td>
   <th><button class='btn-edit' data-eid='{$row["id"]}'>Edit</button></th>
<th><button class='btn-delete' data-id='{$row["id"]}'>Delete</button></th>
      
    </tr>
  
  </tbody>";
  }
  $output.='</table>';
  mysqli_close($conn);
  echo $output;

}

?>

