<?php
if ($_POST) {
  $f = fopen("../data/". $_GET['group'] ."/group.txt", "w");
  $grArr = array($_POST['number'], $_POST['department'], $_POST['starosta'],);
  $grStr = implode(",", $grArr);
  fwrite($f, $grStr);
  fclose($f);

  header('Location: ../index.php?group='. $_GET['group']);
}
$groupFolder = $_GET['group'];
require("../data/declare-group.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/main-style.css">
  <link rel="stylesheet" href="../css/edit-group-form-style.css">
  <title>Редагування групи</title>
</head>

<body>
  <a href="files/group-list/index.php"> На головну</a>
  <form method="post" name="edit-group">
    <div><label for="number">Номер групи</label><input type="text" name="number"></div>
    <div><label for="starosta">Староста</label><input type="text" name="starosta"></div>
    <div><label for="department"> Факультет: </label><input type="text" name="department"></div>
    <div><input type="submit" name="ok" value="змінити" class="submit"></div>
  </form>
</body>

</html>