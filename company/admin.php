<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <title>ADMIN SOLUTION</title>
  <style>
    .alert-container {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1000;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <h2>Список клиентов</h2>

    <a class="btn btn-primary mb-3" href="create.php" role="button">Добавить нового клиента</a>
    <a class="btn btn-primary mb-3" href="statistics.php" role="button">Статистика</a>

    <div class="text-center">
      <!-- Existing code -->
    </div>

    <?php
    include_once 'include/dbh.inc.php';

    // Retrieve total number of records
    $sqlTotalRecords = "SELECT COUNT(*) AS total_records FROM con";
    $resultTotalRecords = $conn->query($sqlTotalRecords);
    $rowTotalRecords = $resultTotalRecords->fetch_assoc();
    $totalRecords = $rowTotalRecords['total_records'];
    ?>

    <h4 class="text-center">Общее количество записей: <?php echo $totalRecords; ?></h4>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Дата</th>
          <th>Имя</th>
          <th>Телефон</th>
          <th>Сообщение</th>
          <th>Действия</th>
        </tr>
      </thead>
      <tbody>
        <?php include_once 'include/read.php'; ?>
      </tbody>
    </table>

    <!-- Button to delete all records -->
    <button type="button" class="btn btn-danger" id="deleteAllButton">Удалить все записи</button>
  </div>

  <!-- Bootstrap Alert Modal -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
       aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmationModalLabel">Удаление записей</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Вы уверены, что хотите удалить все записи?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет, отменить</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteButton">Да, я уверен</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Alert -->
  <div class="alert-container">
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="successAlert" style="display: none;">
      Все записи успешно удалены.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="errorAlert" style="display: none;">
      Ошибка при удалении записей:
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Show Bootstrap Alert
    function showAlert(alertId) {
      const alert = document.getElementById(alertId);
      alert.style.display = 'block';
      setTimeout(() => {
        alert.style.display = 'none';
      }, 3000);
    }

    // Delete all records
    function deleteAllRecords() {
      fetch('include/delete_all.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'delete_all=true'
      })
      .then(response => response.text())
      .then(data => {
        if (data === 'success') {
          showAlert('successAlert');
          location.reload();
        } else {
          showAlert('errorAlert');
        }
      })
      .catch(() => {
        showAlert('errorAlert');
      });
    }

    // Confirmation modal
    const confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));

    // Confirm delete button
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');
    confirmDeleteButton.addEventListener('click', () => {
      deleteAllRecords();
      confirmationModal.hide();
    });

    // Delete all button
    const deleteAllButton = document.getElementById('deleteAllButton');
    deleteAllButton.addEventListener('click', () => {
      confirmationModal.show();
    });
  </script>
</body>
</html>
