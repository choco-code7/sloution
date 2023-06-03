
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
  />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Добавить нового клиента</title>
</head>
<body>
  <div class="container my-5">
    <h2>Добавить нового клиента</h2>

    <!-- <form method="post">
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Имя</label>
        <div class="col-sm-6">
          <input
            type="text"
            class="form-control"
            name="user_name"
            required
    
          />
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Телефон</label>
        <div class="col-sm-6">
          <input
            type="text"
            class="form-control"
            name="user_phone"
            placeholder="+7 XXX XXXX XXX"
            required
         
          />
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Сообщение</label>
        <div class="col-sm-6">
          <textarea
            class="form-control"
            name="user_message"
            rows="5">
        </textarea>
        </div>
      </div>

      <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid mb-1">
          <button type="submit" class="btn btn-primary">Добавить</button>
        </div>
        <div class="col-sm-3 d-grid">
          <a class="btn btn-outline-primary" role="button" href="admin.php">Отменить</a>
        </div>
      </div>
    </form> -->

    <form method="post" action="include/contact.php">
  <input type="hidden" name="form_id" value="3">
  <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Имя</label>
    <div class="col-sm-6">
    <input
  type="text"
  class="form-control"
  name="user_name"
  required
  oninvalid="this.setCustomValidity('Пожалуйста, заполните это поле.')"
  oninput="this.setCustomValidity('')"
/>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Телефон</label>
    <div class="col-sm-6">
    <input
  type="text"
  class="form-control"
  name="user_phone"
  placeholder="+7 XXX XXXX XXX"
  required
  oninvalid="this.setCustomValidity('Пожалуйста, заполните это поле.')"
  oninput="this.setCustomValidity('')"
/>

    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Сообщение</label>
    <div class="col-sm-6">
      <textarea class="form-control" name="user_message" rows="5"></textarea>
    </div>
  </div>
  <div class="row mb-3">
    <div class="offset-sm-3 col-sm-3 d-grid mb-1">
      <button type="submit" class="btn btn-primary">Добавить</button>
    </div>
    <div class="col-sm-3 d-grid">
      <a class="btn btn-outline-primary" role="button" href="admin.php">Отменить</a>
    </div>
  </div>
</form>

  </div>
</body>
</html>
