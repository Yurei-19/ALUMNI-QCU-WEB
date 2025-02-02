<!DOCTYPE html>
<html lang ="en">
    <head>
        <title>ALUMNI</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel ="stylesheet" href ="style.css"/>
        <style>
            .events-table {
                width: 650px;
            height: 600px;
            display: flex;
            flex-wrap: wrap;
            border:black 2px solid;
            max-height: 600px;
            }
            .events-column, .row {
                font-size: 20px;
            width: 100%;
            height: 100%;
            padding: 10px;
            }
            .events-column {
                width: 100%;
            height: 100%;
            }
            .events-low-container{
                width: 650px;
            height: 100px;
            display: flex;
            flex-direction: row;
            border: 2px solid black;
            }
            .row {
            overflow-x: scroll;
            width: 34%;
            align-content: center;
            padding-top: 20px;
            font-weight: bold;
            }
            .scrollable {
                overflow-y: auto; /* This enables vertical scrolling */
             /* Optionally, you can set a height to limit the scrollable area */
                max-height: 600px; /* Adjust the value according to your needs */
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
             
              <h1 class="alumni">ALUMNI DASHBOARD</h1>
            </div>
        <nav>
            <div class="nav">
                <ul>
                <div class="nav-button"><img src="home.png"/> <a href="index2.php"><li>Home</li></a></div>
                <div class="nav-button" style="background: linear-gradient(95deg, rgba(0, 0, 0, 0.76), rgb(99, 99, 235));"><img src="events-icon.png" style="filter: brightness(0) invert(1);"/> <a href="events2.php" style="color: white;"><li>Events</li></a></div>
                    <div class="nav-button" ><img src="community-icon.png " /><a href="community2.php">My Community</a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="addalumni.php"><li>Add Information</li></a></div>
                    <div class="nav-button"><img src="alumni-icon.png" /><a href="alumnilist.php"><li>Alumni List</li></a></div> 
                    <div class="nav-button"><img src="about-icon.png"><a href="about2.php"><li>About</li></a></div> 
                    <div class="nav-button">  <img src="logout-icon.png"><a href="#" id="openModalLink"><li>Logout</li></a></div> 
                </ul>
            </div>
        </nav>
        </header>
        <div class="events-container">
            <div class="h1-date">
                <h1> EVENTS</h1>
            </div>
            <div class="grey-line"></div>
            <div class="title-description-event">
            <?php
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "testdb"; // Change this to your MySQL database name

// Create connection
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
echo "<div class='scrollable'>";
echo "<table class='events-table'><tr class='events-low-container'><th class='events-column'>Event Date</th><th class='events-column'>Event Name</th><th class='events-column'>Event Description</th></tr>";

// Fetch the data from the query result
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr class='events-low-container'>";
    echo "<td class='row'>".$row["EVENTDATE"]."</td>";
    echo "<td class='row'>".$row["EVENTNAME"]."</td>";
    echo "<td class='row'>".$row["EVENTDESCRIPTION"]."</td>";
}
echo "</table>";
echo "</div>";

// Close the database connection
mysqli_close($connection);
?>
            </div>
            <div class="calendar-container">
            <div class="month-container">
            <div class="month">
                                    <strong>January</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button  onclick="change_text()" class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()" class="calendar-number" id="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>May</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>September</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>February</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>June</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>October</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>March</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="uweek()" class="calendar-number-event" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>July</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>November</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>April</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>August</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                    </tr>
                        </table>
            </div>
            <div class="month-container">
            <div class="month">
                                    <strong>December</strong>
                                    <strong>2024</strong>
            </div>  
                        <table>
                                    <tr>
                                                <th>Sun</th>
                                                <th>Mon</th>
                                                <th>Tue</th>
                                                <th>Wed</th>
                                                <th>Thu</th>
                                                <th>Fri</th>
                                                <th>Sat</th>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">1</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">2</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">3</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">4</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">5</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">6</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">7</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">8</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">9</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">10</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">11</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">12</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">13</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">14</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">15</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">16</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">17</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">18</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">19</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">20</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">21</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">22</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">23</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">24</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">25</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">26</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">27</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">28</button></td>
                                    </tr>
                                    <tr>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">29</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">30</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number">31</button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                                <td><button onclick="change_text()"class="calendar-number" id ="calendar-number"></button></td>
                                    </tr>
                        </table>
            </div>
            </div>
            </div>
            </div>
            
        </div>
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
            <script>
                function uweek() {
                var element = document.getElementById("date-events");
                var element2 = document.getElementById("name-event");
                var element3 = document.getElementById("description-event");
                element.textContent = "March 4, 2024";
                element2.textContent = "U-Week";
                element3.textContent = "Celebrating Quezon City University Anniversary";
             }
            </script>                
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