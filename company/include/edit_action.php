<?php
include_once 'dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $id = $_POST['id'];
    $name = $_POST['user_name'];
    $phone = $_POST['user_phone'];
    $message = $_POST['user_message'];

    // Update the database record
    $sql = "UPDATE con SET user_name = '$name', user_phone = '$phone', user_message = '$message' WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result) {
        header("Location: ../admin.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    header("Location: ../admin.php");
    exit;
}
?>
