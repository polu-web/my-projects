<?php
require('../connection.php'); // Adjust path based on your structure

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM `message-box` WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: view-message.php?deleted=success");
        exit;
    } else {
        echo "Error deleting message.";
    }
} else {
    echo "Invalid request.";
}
?>
