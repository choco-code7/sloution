<?php
include_once 'dbh.inc.php';

if (isset($_POST['delete_all'])) {
    // Delete all records from the 'con' table
    $sqlDeleteAll = "TRUNCATE TABLE con";
    if ($conn->query($sqlDeleteAll)) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
