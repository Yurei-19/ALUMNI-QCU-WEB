

<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>ALUMNI</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel ="stylesheet" href ="style.css"/>
        <style>
        /* Container style */
        
        table {
            width: 700px;
            height: 900px;
            display: flex;
            flex-wrap: wrap;
        } 
        th, td {
            font-size: 15px;
            width: 100%;
            height: 100%;
            padding: 10px;
        }
        th {
            width: 100%;
            height: 100%;
        }
        tr {
            width: 700px;
            height: 100px;
            display: flex;
            flex-direction: row;
            border: 2px solid black;
        }
        td {
            overflow-x: scroll;
            width: 25%;
            align-content: center;
            padding-top: 20px;
        }
        .edit-button {
            border-radius: 9px;
            width: 50px;
            height: 25px;
            padding: 5px 0 5px 0;
            align-items: center;
            margin: 2px;
            background-color: green;
            color: white;
        }
        .delete-button {
            border-radius: 9px;
            width: 50px;
            height: 25px;
            padding: 5px 0 5px 0;
            align-items: center;
            margin: 2px;
            background-color: red;
           color: white;
        }
        .input-event-date, .input-event-name, .input-event-description{
            width: 100px;
        }
        .events3-admin-table{
            width: 700px;
            height: 800px;
            border: 2px black solid;
            margin-top: 50px;
            margin-left: 100px;
            overflow-y: auto; /* This enables vertical scrolling */
             /* Optionally, you can set a height to limit the scrollable area */
             max-height: 800px; /* Adjust the value according to your needs */
       
        }
    
        </style>
    </head>
    <body>
        <header class="header">
          <div class="logo-text-container">
            <div class="qcu-logo">
              <img src="qculogo.png" alt="QC University">
            </div>
            <div class="headings">
           
              <h1 class="alumni">ADMIN DASHBOARD</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index3.php"><li>Home</li></a></div>
                <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="events-icon.png" style="filter: brightness(0) invert(1);"/> <a href="events3.php" style="color: white;"><li>Add Events</li></a></div>
                    <div class="nav-button" ><img src="monitoring.png " /><a href="community3.php">Monitoring</a></div>
                    <div class="nav-button"><img src="checkmark.png" /><a href="approval.php"><li>Approval</li></a></div>
                    <div class="nav-button"><img src="crossmark.png" /><a href="archive.php"><li>Archive</li></a></div>
                    <div class="nav-button"><img src="icon-admin.png"/><a href="create-admin.php"><li>Create Admin </li></a></div>
                    <div class="nav-button"><img src="about-icon.png"><a href="about3.php"><li>About</li></a></div>
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div>   
                </ul>
            </div>
        </nav>
        </header>

<div class="events3-outer-container">
<div class="events3-admin-table">
        <?php

$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "testdb"; // Change this to your MySQL database name

// Create connection to MySQL
$connection = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_event'])) {
        // Retrieve data from form
        $eventId = $_POST['event-id'];
        $eventDate = $_POST['event-date'];
        $eventName = $_POST['event-name'];
        $eventDescription = $_POST['event-description'];

        // Execute SQL UPDATE statement
        $sql = "UPDATE event_table SET eventDate = ?, eventName = ?, eventDescription = ? WHERE eventId = ?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "sssi", $eventDate, $eventName, $eventDescription, $eventId);
        mysqli_stmt_execute($statement);
    } elseif (isset($_POST['delete_event'])) {
        // Retrieve event ID to delete
        $eventId = $_POST['event-id'];

        // Execute SQL DELETE statement
        $sql = "DELETE FROM event_table WHERE eventId = ?";
        $statement = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($statement, "i", $eventId);
        mysqli_stmt_execute($statement);
    }
}

// Select all events from the database
$query = 'SELECT EVENTID, EVENTDATE, EVENTNAME, EVENTDESCRIPTION FROM EVENT_TABLE';
$result = mysqli_query($connection, $query);

// Display the data in HTML tables
echo "<table class='table-events3'><tr><th>Event Date</th><th>Event Name</th><th>Event Description</th><th>Actions</th></tr>";

// Fetch the data from the query result
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row["EVENTDATE"]."</td>";
    echo "<td>".$row["EVENTNAME"]."</td>";
    echo "<td>".$row["EVENTDESCRIPTION"]."</td>";
    echo "<td>
            <form id='edit_form_".$row["EVENTID"]."' method='post' style='display:none;'>
                <input type='hidden' name='event-id' value='".$row["EVENTID"]."'>
                <input class='input-event-date' type='date' name='event-date' value='".$row["EVENTDATE"]."'>
                <input class='input-event-name' type='text' name='event-name' value='".$row["EVENTNAME"]."'>
                <input class='input-event-description' type='text' name='event-description' value='".$row["EVENTDESCRIPTION"]."'>
                <button type='submit' name='edit_event' class='edit-button'>Save</button>
            </form>
            <button class='edit-button' onclick='showEditForm(".$row["EVENTID"].")'>Edit</button>
            <form method='post'>
                <input type='hidden' name='event-id' value='".$row["EVENTID"]."'>
                <button type='submit' name='delete_event' class='delete-button' id='delete-button'>Delete</button>
            </form>
          </td>";
    echo "</tr>";
}

echo "</table>";

// Close the database connection
mysqli_close($connection);
?>
</div>
        <div class="events-container3">
        <form id="event-form" action="insert.php" method="POST">
            <div class="top-event3">
                <h1 class="event-details">Event Details</h1>
                <div class="mini-calendar">
                <label for="event-date">Event Date:</label>
                 <input type="date" id="event-date" name="event-date" required>
                </div>
                <p class="description">Description</p>
                <label for="event-name" class="title-events3">Event Name:</label>
                <input type="text" id="event-name" name="event-name" class="title-textbox" required>
            </div>
            <div class="bottom-event3">
            <textarea id="event-description" name="event-description" required></textarea>
            </div>
            <button type="submit"  class="events3-submit" id="update-button">Submit</button>
</form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        document.getElementById("update-button").addEventListener("click", function() {
            var eventDate = document.getElementById("event-date").value;
            var eventName = document.getElementById("event-name").value;
            var eventDescription = document.getElementById("event-description").value;

            document.getElementById("date-events").textContent = eventDate;
            document.getElementById("name-event").textContent = eventName;
            document.getElementById("description-event").textContent = eventDescription;
        });
    });

    function editEvent(eventDate, eventName, eventDescription) {
        // Implement edit functionality here, e.g., opening a modal with inputs prefilled with current values
        // You can use AJAX to send updated data to the server for processing
        console.log("Editing event:", eventDate, eventName, eventDescription);
        // Show alert for event edited
        alert("Event edited!");
    }

    function deleteEvent(eventDate) {
        // Implement delete functionality here, e.g., confirmation dialog before deleting
        // You can use AJAX to send a delete request to the server
        if (confirm("Are you sure you want to delete this event?")) {
            console.log("Deleting event:", eventDate);
            // Send delete request to the server
            // Show alert for event deleted
            alert("Event deleted!");
        }
    }

    function showEditForm(eventId) {
        var form = document.getElementById("edit_form_" + eventId);
        form.style.display = "block";
    }
</script>


<button class="close-button-admin-dashboard" type="button" id="close" style="display: none;">X</button>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <h1 class="log-out-h1">Log Out</h1>
                <p class="log-out-p">Are you sure you want to log out?</p>
                <div class="grey-box">
                <div class="transparent-border-box">
                <span class="close">Cancel</span>
                </div>
                <div class="blue-border-box">
                <a href="logout.php" class="modal-log-out-button">Logout</a>
                </div>
                </div>

            </div>
        </div>
        <script src ="main.js">
            // Get the modal

        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        </div>
        
    </body>
</html>