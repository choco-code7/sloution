<?php
include_once 'include/dbh.inc.php';

// Function to readjust IDs after deleting a record
function readjustIDs() {
  global $conn;

  // Get all records ordered by ID
  $sql = "SELECT id FROM con ORDER BY id";
  $result = $conn->query($sql);

  if ($result) {
    $ids = array();
    while ($row = $result->fetch_assoc()) {
      $ids[] = $row['id'];
    }

    // Update the IDs in the database
    for ($i = 0; $i < count($ids); $i++) {
      $newID = $i + 1;
      $sql = "UPDATE con SET id = '$newID' WHERE id = '{$ids[$i]}'";
      $conn->query($sql);
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['delete_id'])) {
  // Get the ID of the record to delete
  $deleteID = $_GET['delete_id'];

  // Delete the record from the database
  $sql = "DELETE FROM con WHERE id = '$deleteID'";
  $result = $conn->query($sql);

  if ($result) {
    // Readjust the IDs of the remaining records
    readjustIDs();

    // Redirect back to the page
    header('Location: admin.php');
    exit;
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}

$sql = "SELECT * FROM con";
$result = $conn->query($sql);

if (!$result) {
  die("Некорректный запрос: " . $conn->error);
}

while ($row = $result->fetch_assoc()) {
  $date = date("d F Y", strtotime($row['date']));
  echo "
  <tr>
    <td>{$row['id']}</td>
    <td>{$date}</td>
    <td>{$row['user_name']}</td>
    <td>{$row['user_phone']}</td>
    <td>{$row['user_message']}</td>
    <td>
      <a class=\"btn btn-primary btn-sm\" href=\"edit.php?id={$row['id']}\" style=\"margin-bottom: 5px;\">редактировать</a>
      <a class=\"btn btn-danger btn-sm\" href=\"?delete_id={$row['id']}\">удалить</a>
    </td>
  </tr>";
}
?>
