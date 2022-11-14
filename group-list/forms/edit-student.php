<?php
if ($_POST) {
  $f = fopen("/var/www/public/files/group-list/data/". $_GET['group']. "/" . $_GET['file'], "w");
  $privilege = 0;
  if ($_POST['stud_privelege'] == 1) {
    $privilege = 1;
  }
  $grArr = array($_POST['stud_name'], $_POST['stud_gender'], $_POST['stud_dob']);
  $grStr = implode(";", $grArr);
  fwrite($f, $grStr);
  fclose($f);
  header('Location: ../index.php?group=' . $_GET['group']);
}
$groupFolder = $_GET['group'];

$path = "/var/www/public/files/group-list/data/" . $_GET['group'];
$node = $_GET['file'];
$student = require "/var/www/public/files/group-list/data/declare-student.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="../css/edit-student-form-style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Редагування студента</title>
</head>

<body>
  <a href="../index.php">На головну</a>
  <form method="post" name="edit-student">
    <div>
      <label for="stud_name">Прізвище :</label>
      <input type="text" name="stud_name" value=<?php echo $student['name']; ?>>
    </div>
    <div><label for="stud_gender">Стать : </label>
      <select name="stud_gender" id="stud_gender">
        <option disabled>Стать</option>
        <option <?php echo ("чол" == $student["gender"]) ? "selected" : ""; ?> value="чол">Чоловіча</option>
        <option <?php echo ("жін" == $student["gender"]) ? "selected" : ""; ?>value="жін">Жіноча</option>
      </select>
    </div>
    <div>
      <label for="stud_dob">Дата народження :</label>
      <input type="date" name="stud_dob" value=<?php echo date("Y-m-d", strtotime($student['dob'])); ?>>
    </div>
    <div class="privilege">
      <label for="stud_privilege">пільга</label>
      <input type="checkbox" <?php echo ("1" == $student['privelege']) ? "checked" : ""; ?> name="stud_privilege">
    </div>
    <div><input type="submit" name="ok" value="змінити" class="submit"></div>
  </form>
</body>

</html>