<?php
    // Setup session
    session_start();
    
    // Unset session vars
    $_SESSION = array();
    
    // Destroy
    session_destroy();
    
    // Redirect to login page
    header("location: signin.php");
    exit;
?>