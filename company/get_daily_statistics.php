<?php
// include_once 'include/dbh.inc.php';

// if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['month'])) {
//   $selectedMonth = $_GET['month'];

//   $sql = "SELECT DAY(STR_TO_DATE(`date`, '%e %b %Y')) AS day, COUNT(*) AS count FROM con WHERE MONTH(STR_TO_DATE(`date`, '%e %b %Y')) = $selectedMonth GROUP BY day";
//   $result = $conn->query($sql);

//   if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//       $day = $row['day'];
//       $count = $row['count'];

//       echo '<tr><td>' . $day . '</td><td>' . $count . '</td></tr>';
//     }
//   } else {
//     echo '<tr><td colspan="2">Нет данных о записях за выбранный месяц.</td></tr>';
//   }
// }



include_once 'include/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['month'])) {
  $selectedMonth = $_GET['month'];

  // Get the total number of days in the selected month
  $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, date('Y'));

  // Query to retrieve the records for each day of the selected month
  $sql = "SELECT DAY(STR_TO_DATE(`date`, '%e %b %Y')) AS day, COUNT(*) AS count FROM con WHERE MONTH(STR_TO_DATE(`date`, '%e %b %Y')) = $selectedMonth GROUP BY day";
  $result = $conn->query($sql);

  // Create an array to store the count for each day
  $dailyCounts = array();

  // Initialize the array with 0 counts for each day
  for ($day = 1; $day <= $daysInMonth; $day++) {
    $dailyCounts[$day] = 0;
  }

  // Update the array with the actual counts from the query result
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $day = $row['day'];
      $count = $row['count'];

      $dailyCounts[$day] = $count;
    }
  }

  // Generate the table rows for each day, including those without records
  for ($day = 1; $day <= $daysInMonth; $day++) {
    $count = $dailyCounts[$day];

    echo '<tr><td>' . $day . '</td><td>' . $count . '</td></tr>';
  }
}
?>

