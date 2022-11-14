<?php
if ($_POST) {
  $nameTpl = '/^student-\d\d.txt\z/';
  $path = "/var/www/public/files/group-list/data/" . $_GET["group"];
  $conts = scandir($path);
  $i = 0;
  foreach ($conts as $node) {
    if (preg_match($nameTpl, $node)) {
      $last_file = $node;
    }
  }

  $file_index = (string)(((int)substr($last_file, -6, 2)) + 1);
  if (strlen($file_index) == 1) {
    $file_index = "0" . $file_index;
  }

  $newFileName = "student-" . $file_index . ".txt";

  $f = fopen("/var/www/public/files/group-list/data/" . $_GET['group'] . "/" . $newFileName, "w");
  $privilege = 0;
  if ($_POST['stud-privilege'] == 1) {
    $privilege = 1;
  }

  $grArr = array($_POST['stud_name'], $_POST['stud_gender'], $_POST['stud_dob'], $privilege,);
  $grStr = implode(";", $grArr);
  fwrite($f, $grStr);
  fclose($f);
  header('Location: ../index.php?group=' . $_GET['group']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/edit-student-form-style.css">
  <title>Додавання студента</title>
</head>

<body>
  <a href="../index.php">На головну</a>
  <form method="POST" name="edit-student">
    <div>
      <label for="stud_name">Прізвище :</label>
      <input type="text" name="stud_name">
    </div>
    <div><label for="stud_gender">Стать : </label>
      <select name="stud_gender" id="">
        <option disabled>Стать</option>
        <option value="чол">Чоловіча</option>
        <option value="жін">Жіноча</option>
      </select>
    </div>
    <div>
      <label for="stud_dob">Дата народження :</label>
      <input type="date" name="stud_dob">
    </div>
    <div class="privilege">
      <label for="stud_privilege">пільга</label>
      <input type="checkbox" name="stud_privilege">
    </div>
    <div><input type="submit" name="ok" value="додати" class="submit"></div>
  </form>
</body>

</html>