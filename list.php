<html>
    <head>
        <title>Ajax CRUD</title>
        <style>
            /* Styling for modal dialogs */
            #modal, #edit-modal {
                display: none;
                background: rgba(0, 0, 0, 0.7);
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                z-index: 100;
            }
            .modal-form, .edit-modal-form {
                background: #fff;
                width: 30%;
                position: relative;
                top: %;
                left: 35%;
                padding: 15px;
                border-radius: 4px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            }
            .modal-form input, .edit-modal-form input, .modal-form select, .edit-modal-form select {
                width: 50%;
                margin: 10px 0;
                padding: 8px;
            }
            .form-group {
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body align="center">
        <h2>AJAX CRUD Application</h2>
        
        <!-- Table to display records -->
        <table class="table" id="table-data" border="1" align="center">
            <!-- Table data will be loaded here from view.php -->
        </table>

        <!-- Add Record Modal -->
        <div id="modal">
            <div class="modal-form">
                <h2>Add New Record</h2>
                <form id="myform" action="save.php" method="post">
                <div class="form-group">
                        <label>Name:</label>
                        <input type="file" id="upload_file" name="file" placeholder="Username"  />
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" id="name" name="name" placeholder="Username"  />
                    </div>
                    <div class="form-group">
                        <label>Mobile No:</label>
                        <input type="text" id="mobno" name="mobileno" placeholder="Mobile Number" maxlength="10"  />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" id="email" name="email" placeholder="Email"  />
                    </div>
                    <div class="form-group">
                        <label>Date of Birth:</label>
                        <input type="date" id="birthday" name="dob"  />
                    </div>
                    <div class="form-group">
                        <label>Country:</label>
                        <select id="country"  name="country" >
                            <option selected="selected">Select Country</option>
                            <!-- Country options will be populated here from PHP -->
                            <?php
                                include "connection.php";
                                $sql = "SELECT * FROM countries ORDER BY c_name";
                                $result = mysqli_query($conn, $sql);
                                while($rows = mysqli_fetch_assoc($result)) {
                                    echo '<option value="'.$rows['c_id'].'">'.$rows['c_name'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>State:</label>
                        <select id="state"  name="state" >
                            <option selected="selected">Select State</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>City:</label>
                        <select id="city" name="city" >
                            <option selected="selected">Select City</option>
                        </select>
                    </div>
                    <button id="savebtn" type="submit">Save</button>
                    <button type="button" id="close-btn">Close</button>
                </form>
            </div>
        </div>

        <!-- Edit Record Modal -->
        <div id="edit-modal">
            
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://malsup.github.io/jquery.form.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function(){
                // Load table data from view.php
                function loadTable() {
                    $.ajax({
                        type: "POST",
                        url: "view.php",
                        success: function (data) {
                            $("#table-data").html(data);
                        }
                    });
                }
                    loadTable(); 
                
               

                // Open add modal
                $(document).on("click", ".add-btn", function(){
                    $("#modal").show();
                });

                // Close modals
                $(document).on("click", "#close-btn", function(){
                    $("#modal").hide();
                });
                $(document).on("click", ".edit-close-btn", function(){
                    $("#edit-modal").hide();
});
              

                // Populate states based on country selection
                $("#country").on("change", function () { 
                    var country_id = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "address.php",
                        data: {c_id: country_id},
                        success: function (data) {
                            $("#state").html(data);
                            $("#city").html("<option>Select City</option>"); 
                        }
                    });
                });

                // Populate cities based on state selection
                
                $("#state").on("change", function() {
                    var state_id = $(this).val();
                    

                    $.ajax({
                        type: "POST",
                        url: "address.php",
                        data: {s_id: state_id},
                        success: function(data){
                            $("#city").html(data);
                        }
                    });
                
                });
            

                // Save new record
                $("#savebtn").on("click", function(e) {
                    //e.preventDefault();
                    $("#myform").ajaxForm({
                        success:function(data){
                           alert("heee");
                            if (data == 0) {
                                Swal.fire("Error", "Something went wrong!", "error"); 
                            } else {
                                loadTable();
                                $("#modal").hide();
                                Swal.fire("Success", "New Record Added Successfully", "success");
                            }

                        }

                    });

                });

                
              // Edit record
$(document).on("click", ".btn-edit", function () {
    var recordId = $(this).data("eid");
    $.ajax({
        type: "POST",
        url: "fetch_single.php", 
        data: { id: recordId },
        success: function (data) {
            $("#edit-modal").html(data);
            $("#edit-modal").show();

            $("#editsavebtn").on("click", function(e) {
                    //alert("hiii");
                $("#emyform").ajaxForm({
                    
                    success:function(data){
                         
                            if (data == 0) {
                                Swal.fire("Error", "Something went wrong!", "error");
                                
                            } else {
                                loadTable();
                                $("#edit-modal").hide();
                                Swal.fire("Success", "New Record Added Successfully", "success");
                            }


                    }

                });

         });

            //Load states based on selected country in the edit form
                $("#edit-country").on("change", function () { 
                    var country_id = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "address.php",
                        data: {c_id: country_id},
                        success: function (data) {
                            $("#edit-state").html(data);
                            $("#edit-city").html("<option>Select City</option>"); 
                    }
                    });
                });
                $("#edit-state").on("change", function() {
                    var state_id = $(this).val();
            
                    $.ajax({
                        type: "POST",
                        url: "address.php",
                        data: {s_id: state_id},
                        success: function(data){
                            $("#edit-city").html(data);
                            var selectedCity = $("#edit-city").data("selected-city");
                            $("#edit-city").val(selectedCity);
                        }
                            
                        });
                        
                    });
        }
    });
});

                
                // Delete record
                $(document).on("click", ".btn-delete", function(){
                    var u_id = $(this).data("id");
                    var element = this;
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "delete.php",
                                data: { id: u_id },
                                success: function (data) {
                                    if(data == 1){
                                        $(element).closest("tr").fadeOut();
                                        Swal.fire("Deleted!", "Your record has been deleted.", "success");
                                    } else {
                                        Swal.fire("Error", "Unable to delete record.", "error");
                                    }
                                }
                            });
                        }
                    });
                });

                //update 
          

            });
        </script>
    </body>
</html>
