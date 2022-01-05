<?php 
    // Include Constants.php For SITEURL
    include('../config/constants.php');
    // 1. Destroy The Session
    session_destroy(); // Unset $_SESSION['user']

    // 2. Redirect To Login Page
    header('location:'.SITEURL.'admin/login.php');
?>