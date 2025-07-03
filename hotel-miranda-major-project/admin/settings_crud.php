<?php
// Include your database connection file and essentials
require('db-config.php');
require('essentials.php');

// Fetch the current contact details from the database
if (isset($_POST['get_contacts'])) {
    $q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];  // Assuming we have one row with sr_no = 1
    $datatypes = 'i';  // Integer type for sr_no
    $res = select($q, $values, $datatypes);
    $data = mysqli_fetch_assoc($res);  // Fetch the data as an associative array
    echo json_encode($data);  // Return the data as JSON for AJAX
    exit;  // Exit after sending the data to avoid further script execution
}

// Update the contact details in the database
if (isset($_POST['upd_contacts'])) {
    // Sanitize the form data
    $frm_data = filteration($_POST);
    
    // Prepare the update SQL query to update the contact details
    $q = "UPDATE `contact_details` SET `address`=?, `email`=?, `pn1`=? WHERE `sr_no`=?";
    $values = [$frm_data['address'], $frm_data['email'], $frm_data['pn1'], 1];  // Assuming sr_no = 1
    $datatypes = 'sssi';  // 's' for string, 'i' for integer
    $res = update($q, $values, $datatypes);
    
    echo $res;  // Return the result of the update operation (1 for success)
    exit;
}
?>


