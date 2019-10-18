<?php
    session_start();
    if(session_destroy())  {
    header("Location: http://localhost/ZeroWeapon/pages/examples/login.php"); // Redirecting To Home Page
    }
    ?>