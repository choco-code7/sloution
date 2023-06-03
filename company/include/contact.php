 <?php


include_once 'dbh.inc.php';

$name = $_POST['user_name'];
$phone = $_POST['user_phone'];
$message = $_POST['user_message'];

$sql = "INSERT INTO con (user_name, user_phone, user_message)
         VALUES('$name', '$phone', '$message');";

if (mysqli_query($conn, $sql)) {
    if ($_POST['form_id'] == 1) {
        header("Location: ../success-ru.php");
        exit;
    } elseif ($_POST['form_id'] == 2) {
        header("Location: ../success-kz.php");
        exit;
    } elseif ($_POST['form_id'] == 3) {
        header("Location: ../admin.php");
        exit;
    }
} else {
    $error_message = "Ошибка: " . mysqli_error($conn);
    $russian_error_message = iconv("CP1251", "UTF-8", $error_message);
    echo $russian_error_message;
}
?>


   





 
  


    


