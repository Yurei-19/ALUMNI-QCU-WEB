<?php 

//click here to  <a href = " logout.php">logout </a> // sa html nakalagay toh

session_start();

if(session_destroy()) {
    header("Location: admin-login.php");
}
?>
