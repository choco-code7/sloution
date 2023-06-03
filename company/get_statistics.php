<?php
include_once 'include/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['month'])) {
  $selectedMonth = $_GET['month'];

  $sql = "SELECT COUNT(*) AS count FROM con WHERE MONTH(STR_TO_DATE(`date`, '%e %b %Y')) = $selectedMonth";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $recordCount = $row['count'];

  echo $recordCount;
}
?>
