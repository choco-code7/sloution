<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Редактировать</title>
</head>
<body>
    <div class="container my-5">
        <h2>Редактировать информацию клиента</h2>

        <?php
        include_once 'include/dbh.inc.php';

        // Check if the ID parameter is provided in the URL
        if (!isset($_GET['id'])) {
            header('Location: admin.php');
            exit;
        }

        $id = $_GET['id'];

        // Retrieve the row from the database using the provided ID
        $sql = "SELECT * FROM con WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if (!$row) {
            header('Location: admin.php');
            exit;
        }

        // Set the values for the form inputs
        $name = $row['user_name'];
        $phone = $row['user_phone'];
        $message = $row['user_message'];
        ?>

        <form method="post" action="include/edit_action.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Имя</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="user_name" required value="<?php echo $name; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Телефон</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="user_phone" required value="<?php echo $phone; ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Сообщение</label>
                <div class="col-sm-6">
                    <textarea class="form-control" name="user_message" rows="5"><?php echo $message; ?></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid mb-1">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" role="button" href="admin.php">Отменить</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
