<?php 

//click here to  <a href = " logout-alumni.php">logout </a> // sa html nakalagay toh

session_start();

if(session_destroy()) {
    header("Location: alumni-sign-up.php");
}
?>