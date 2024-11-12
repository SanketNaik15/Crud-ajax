<?php
include "connection.php"; // Database connection

$id = $_POST['id'];
$sql = "SELECT users.id, users.name, users.email, users.mobileno, users.date_of_birth, users.img_name, 
        users.country AS country_id, users.state AS state_id, users.city AS city_id, 
        countries.c_name, states.s_name, cities.ci_name 
        FROM users
        JOIN countries ON users.country = countries.c_id
        JOIN states ON users.state = states.s_id
        JOIN cities ON users.city = cities.ci_id 
        WHERE users.id = '$id'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Start building the modal form output
    $output = '
    <div class="edit-modal-form">
        <h2>Edit Record</h2>
        <form id="emyform" action="edit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="sid" id="edit-id" value="' . $row["id"] . '">

            <div class="form-group">
                <label>Current Image:</label><br>
                <img id="current-image" src="./Images/' . $row["img_name"] . '" width="80" height="80"><br><br>
            </div>
            <div class="form-group">
                <label>Update Image:</label>
                <input type="file" name="profile_image" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="username" id="edit-name" value="' . $row["name"] . '" placeholder="Username" />
            </div>
            <div class="form-group">
                <label>Mobile No:</label>
                <input type="text" name="mobileno" id="edit-mobno" value="' . $row["mobileno"] . '" placeholder="Mobile Number" maxlength="10" />
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" id="edit-email" value="' . $row["email"] . '" placeholder="Email" />
            </div>
            <div class="form-group">
                <label for="birthday">Date of Birth:</label>
                <input type="date" id="edit-birthday" name="birthday" value="' . $row["date_of_birth"] . '" />
            </div>';

    // Fetch countries for dropdown
    $countryQuery = "SELECT * FROM countries ORDER BY c_name";
    $countryResult = mysqli_query($conn, $countryQuery);

    $output .= '<div class="form-group">
                    <label>Country:</label>
                    <select id="edit-country" name="country">';
    while ($countryRow = mysqli_fetch_assoc($countryResult)) {
        $selected = ($row["country_id"] == $countryRow["c_id"]) ? 'selected' : '';
        $output .= '<option value="' . $countryRow["c_id"] . '" ' . $selected . '>' . $countryRow["c_name"] . '</option>';
    }
    $output .= '</select>
                </div>';

    // Fetch states for dropdown
    $stateQuery = "SELECT * FROM states WHERE c_id=" . $row["country_id"] . " ORDER BY s_name";
    $stateResult = mysqli_query($conn, $stateQuery);

    $output .= '<div class="form-group">
                    <label>State:</label>
                    <select id="edit-state" data-selected-state="' . $row["state_id"] . '" name="state">';
    while ($stateRow = mysqli_fetch_assoc($stateResult)) {
        $selected = ($row["state_id"] == $stateRow["s_id"]) ? 'selected' : '';
        $output .= '<option value="' . $stateRow["s_id"] . '" ' . $selected . '>' . $stateRow["s_name"] . '</option>';
    }
    $output .= '</select>
                </div>';

    // Fetch cities for dropdown
    $cityQuery = "SELECT * FROM cities WHERE s_id=" . $row["state_id"] . " ORDER BY ci_name";
    $cityResult = mysqli_query($conn, $cityQuery);

    $output .= '<div class="form-group">
                    <label>City:</label>
                    <select id="edit-city" data-selected-city="' . $row["city_id"] . '" name="city">';
    while ($cityRow = mysqli_fetch_assoc($cityResult)) {
        $selected = ($row["city_id"] == $cityRow["ci_id"]) ? 'selected' : '';
        $output .= '<option value="' . $cityRow["ci_id"] . '" ' . $selected . '>' . $cityRow["ci_name"] . '</option>';
    }
    $output .= '</select>
                </div>';

    // Buttons
    $output .= '<button id="editsavebtn" type="submit">Update</button>
                <button type="button" class="edit-close-btn">Close</button>
            </form>
        </div>';


    mysqli_close($conn);

    echo $output;

} else {
    echo "Record not found!";
}
