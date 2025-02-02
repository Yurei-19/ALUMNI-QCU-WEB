<?php

session_start();
// Database connection
$conn = new mysqli("localhost", "root", "", "testdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the "create" button is clicked
if(isset($_POST['create'])) {
    // Handle file upload
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["my_image"]["name"]);
    move_uploaded_file($_FILES["my_image"]["tmp_name"], $target_file);

    // Set parameters
    $alumni_id = $_SESSION["user_id"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $middlename = $_POST["middlename"];
    $age = $_POST["age"];
    $contactnumber = $_POST["contactnumber"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $course = $_POST["course"];
    $campus = $_POST["campus"];
    $facebooklink = $_POST["facebooklink"];
    $description = $_POST["description"];
    $profile_picture = $target_file;

    $check_profile_query = "SELECT * FROM ADD_ALUMNI_PROFILE WHERE alumni_id = ?";
    $stmt_profile = $conn->prepare($check_profile_query);
    $stmt_profile->bind_param("i", $alumni_id);
    $stmt_profile->execute();
    $result_profile = $stmt_profile->get_result();
    
    // Check if record with alumni ID exists in ADD_ALUMNI table
    $check_alumni_query = "SELECT * FROM ADD_ALUMNI WHERE alumni_id = ?";
    $stmt_alumni = $conn->prepare($check_alumni_query);
    $stmt_alumni->bind_param("i", $alumni_id);
    $stmt_alumni->execute();
    $result_alumni = $stmt_alumni->get_result();
    
    // Check if record with alumni ID exists in REJECT_ALUMNI_LIST table
    $check_reject_query = "SELECT * FROM REJECT_ALUMNI_LIST WHERE alumni_id = ?";
    $stmt_reject = $conn->prepare($check_reject_query);
    $stmt_reject->bind_param("i", $alumni_id);
    $stmt_reject->execute();
    $result_reject = $stmt_reject->get_result();
    
    // Perform actions based on the results of each query
    if ($result_profile->num_rows > 0 || $result_alumni->num_rows > 0 || $result_reject->num_rows > 0) {
        // Update operation
        $update_profile_stmt = $conn->prepare("UPDATE ADD_ALUMNI_PROFILE SET firstname=?, lastname=?, middlename=?, age=?, contactnumber=?, email=?, address=?, course=?, campus=?, facebooklink=?, description=?, profile_picture=? WHERE alumni_id=?");
        $update_profile_stmt->bind_param("sssiisssssssi", $firstname, $lastname, $middlename, $age, $contactnumber, $email, $address, $course, $campus, $facebooklink, $description, $profile_picture, $alumni_id);
    
        $update_stmt = $conn->prepare("UPDATE ADD_ALUMNI SET firstname=?, lastname=?, middlename=?, age=?, contactnumber=?, email=?, address=?, course=?, campus=?, facebooklink=?, description=?, profile_picture=? WHERE alumni_id=?");
        $update_stmt->bind_param("sssiisssssssi", $firstname, $lastname, $middlename, $age, $contactnumber, $email, $address, $course, $campus, $facebooklink, $description, $profile_picture, $alumni_id);
    
        $update_reject_stmt = $conn->prepare("UPDATE REJECT_ALUMNI_LIST SET firstname=?, lastname=?, middlename=?, age=?, contactnumber=?, email=?, address=?, course=?, campus=?, facebooklink=?, description=?, profile_picture=? WHERE alumni_id=?");
        $update_reject_stmt->bind_param("sssiisssssssi", $firstname, $lastname, $middlename, $age, $contactnumber, $email, $address, $course, $campus, $facebooklink, $description, $profile_picture, $alumni_id);
        
        // Execute UPDATE statement
        if ($update_stmt->execute()) {
            echo '<script>alert("Profile and Information Updated!"); window.location.href = "addalumni.php";</script>';
        } else {
            echo "Error updating record: " . $update_stmt->error;
        }
        if ($update_profile_stmt->execute()) {
            echo '<script>alert("Profile Updated!"); window.location.href = "addalumni.php";</script>';
        } else {
            echo "Error updating profile record: " . $update_profile_stmt->error;
        }
        if ($$update_reject_stmt->execute()) {
            echo '<script>alert("Profile Updated!"); window.location.href = "addalumni.php";</script>';
        } else {
            echo "Error updating profile record: " . $update_profile_stmt->error;
        }
        
    } else {
        // Insert operation
        $insert_stmt = $conn->prepare("INSERT INTO ADD_ALUMNI (alumni_id, firstname, lastname, middlename, age, contactnumber, email, address, course, campus, facebooklink, description, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("isssiisssssss", $alumni_id, $firstname, $lastname, $middlename, $age, $contactnumber, $email, $address, $course, $campus, $facebooklink, $description, $profile_picture);
    
        $insert_profile_stmt = $conn->prepare("INSERT INTO ADD_ALUMNI_PROFILE (alumni_id, firstname, lastname, middlename, age, contactnumber, email, address, course, campus, facebooklink, description, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_profile_stmt->bind_param("isssiisssssss", $alumni_id, $firstname, $lastname, $middlename, $age, $contactnumber, $email, $address, $course, $campus, $facebooklink, $description, $profile_picture);
    
        // Execute INSERT statement
        if ($insert_stmt->execute() && $insert_profile_stmt->execute()) {
            echo '<script>alert("Profile and Information Added!"); window.location.href = "addalumni.php";</script>';
        } else {
            echo "Error creating record: " . $insert_stmt->error;
        }
    }
    
    // Close statements
    $stmt_profile->close();
    $stmt_alumni->close();
    $stmt_reject->close();
}
// Close connection
$conn->close();
?>



<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>ALUMNI</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel ="stylesheet" href ="style.css"/>
        
    </head>
    <body>
        <header class="header">
          <div class="logo-text-container">
            <div class="qcu-logo">
              <img src="qculogo.png" alt="QC University">
            </div>
            <div class="headings">
            
              <h1 class="alumni">ALUMNI DASHBOARD</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index2.php"><li>Home</li></a></div>
                    <div class="nav-button"><img src="events-icon.png" /><a href="events2.php"><li>Events</li></a></div>
                    <div class="nav-button" ><img src="community-icon.png " /><a href="community2.php">My Community</a></div>
                    <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="alumni-icon.png" style="filter: brightness(0) invert(1);"/> <a href="addalumni.php" style="color: white;"><li>Add Information</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="alumnilist.php"><li>Alumni List</li></a></div>
                 
                    <div class="nav-button"><img src="about-icon.png"><a href="about2.php"><li>About</li></a></div> 
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="alumni-form-container">
            <form action="addalumni.php" method="post" enctype="multipart/form-data">
            <div class="left-side-addalumni">
                <div class="img-container-addalumni">
                  <h1 class="profile-picture">UPLOAD PROFILE PICTURE</h1>
                <input type="file" name="my_image" class="upload-type" required/>
                </div>
                <button type="submit" class="create-account-addalumni" name="create">Add Information</button>
            </div>
            
            <div class="right-side-addalumni">
                <input name="firstname" type="text" class="text-box-top-addalumni1" placeholder="Firstname" required/><input name="lastname" type="text" class="text-box-top-addalumni1" placeholder="Lastname" required/>
                <input name="middlename" type="text" class="text-box-top-addalumni2" placeholder="Middlename" required/><input name="age" type="number" class="text-box-top-addalumni2" placeholder="Age" required/><input name="contactnumber" type="text" class="text-box-top-addalumni2" placeholder="Contact Number" required oninput="if(this.value.length > 11) this.value = this.value.slice(0, 11).replace(/\D/g,'')" pattern="\d{0,11}" title="Please enter a valid contact number (up to 11 digits)." />

                <input name="email" type="text" class="text-box-bottom-addalumni" placeholder="Email" required/>
                <input name="address" type="text" class="text-box-bottom-addalumni" placeholder="Address" required/>
                <input name="course" type="text" class="text-box-bottom-addalumni" placeholder="Course" required/>
                <input name="campus" type="text" class="text-box-bottom-addalumni" placeholder="Campus" required/>
                <input name="facebooklink" type="text" class="text-box-bottom-addalumni" placeholder="Facebook link" required/>
                <textarea name="description" class="addalumni-textarea" placeholder="Description" ></textarea>
            </div>
            </form>
        </div>
        <button type="button" id="close" style="display: none;">X</button>    
        <div id="myModal" class="modal">
            <div class="modal-content">
                <h1 class="log-out-h1">Log Out</h1>
                <p class="log-out-p">Are you sure you want to log out?</p>
                <div class="grey-box">
                <div class="transparent-border-box">
                <span class="close">Cancel</span>
                </div>
                <div class="blue-border-box">
                <a href="logout-alumni.php" class="modal-log-out-button">Logout</a>
                </div>
                </div>

            </div>
        </div>
        <script src ="main.js">
            // Get the modal

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </body>
</html>