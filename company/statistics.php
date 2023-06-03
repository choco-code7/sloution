<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Страница статистики</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">Статистика</h2>
    <div class="form-group">
      <label for="month">Выберите месяц:</label>
      <select class="form-control" id="month" name="month">
        <option value="">Выберите...</option>
      </select>
    </div>
    <button type="button" class="btn btn-primary" onclick="showStatistics()">Показать статистику</button>

    <div id="statistics" class="mt-4" style="display: none;">
      <h3 id="selectedMonthTitle"></h3>
      <p id="recordCount"></p>
      <table class="table">
        <thead>
          <tr>
            <th>День</th>
            <th>Количество записей</th>
          </tr>
        </thead>
        <tbody id="dailyRecords"></tbody>
      </table>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://momentjs.com/downloads/moment.min.js"></script>
  <script>
    // Заполнение выпадающего списка месяцев динамически
    $(document).ready(function() {
      var $monthSelect = $('#month');
      var currentMonth = moment().month() + 1; // Получение текущего месяца (1-12)

      // Генерация опций для последних 12 месяцев
      var russianMonths = [
        'январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'
      ];

      for (var i = 0; i < 12; i++) {
        var monthNum = (currentMonth - i + 12) % 12;
        if (monthNum === 0) monthNum = 12;
        var monthName = russianMonths[monthNum - 1];
        $monthSelect.append($('<option>', {
          value: monthNum,
          text: monthName
        }));
      }
    });

    function showStatistics() {
      var selectedMonth = $('#month').val();

      if (selectedMonth !== '') {
        var monthName = moment().month(selectedMonth - 1).format('MMMM');
        var russianMonthName = getRussianMonthName(selectedMonth - 1);
        $('#selectedMonthTitle').text('Статистика за ' + russianMonthName);

        $.ajax({
          url: 'get_statistics.php',
          method: 'GET',
          data: {
            month: selectedMonth
          },
          success: function(response) {
            $('#recordCount').text('Количество записей за месяц: ' + response);
            $('#statistics').show();
            showDailyRecords(selectedMonth);
          },
          error: function() {
            console.log('Произошла ошибка при получении статистики.');
          }
        });
      }
    }

    function showDailyRecords(selectedMonth) {
      $.ajax({
        url: 'get_daily_statistics.php',
        method: 'GET',
        data: {
          month: selectedMonth
        },
        success: function(response) {
          $('#dailyRecords').html(response);
        },
        error: function() {
          console.log('Произошла ошибка при получении статистики по дням.');
        }
      });
    }

    function getRussianMonthName(monthIndex) {
      var russianMonths = [
        'января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
      ];

      return russianMonths[monthIndex];
    }
  </script>
  
</body>

</html>
