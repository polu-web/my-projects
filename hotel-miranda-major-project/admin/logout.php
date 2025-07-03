<?php
require('db-config.php');
require('essentials.php');
session_start();
session_unset();  // Unset all session variables
session_destroy(); // Destroy the session

// Redirect to admin_index.php
header("Location: ../admin/admin_index.php");
exit;
?>