<?php
require '../auth/check-auth.php';
if (!CheckRight('user', 'admin')) {
  die('Ви не маєте права на виконання цієї інформації');
}
if ($_POST) {
  require '../data/declare-users.php';
  foreach ($data['users'] as $key => $user) {
    if ($user['name'] == $_POST['user_name']) {
      break;
    }
  }
  $rights = "";
  for ($i = 0; $i < 9; $i++) {
    if ($_POST['right' . $i]) {
      $rights .= "1";
    } else {
      $rights .= "0";
    }
  }
  $data['users'][$key] = array(
    'name' => $_POST['user_name'],
    'pwd' => $_POST['user_pwd'],
    'rights' => $rights . "\r\n",
  );
  $f = fopen("/var/www/public/files/group-list/data/users.txt", "w");
  foreach ($data['users'] as $user) {
    $grArr = array($user['name'], $user['pwd'], $user['rights'],);
    $grStr = implode(';', $grArr);
    fwrite($f, $grStr);
  }
  fclose($f);
  header('Location: index.php');
}

require "/var/www/public/files/group-list/data/declare-users.php";
foreach ($data['users'] as $user) {
  if ($user['name'] == $_GET['username']) {
    break;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/main-style.css">
  <link rel="stylesheet" href="../css/edit-group-form-style.css">
  <link rel="stylesheet" href="../css/admin.css">

  <title>Редагування користувача</title>
</head>

<body>
  <a href="index.php">До списку користувачів</a>
  <form name="edit-user" method="post">
    <div>
      <div>
        <label for="user_name">Username: </label>
        <input readonly type="text" name="user_name" value='<?php echo $user['name'] ?>'>
      </div>
      <div>
        <label for="user_pwd">Password: </label>
        <input type="text" name="user_pwd" value='<?php echo $user['pwd'] ?>'>
      </div>
      <div class="type">
        <p>Група: </p>
        <span>перегляд</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][0]) ? "checked" : ""; ?> name="right0" value="1">
        <span>створення</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][1]) ? "checked" : ""; ?> name="right1" value="1">
        <span>редагування</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][2]) ? "checked" : ""; ?> name="right2" value="1">
        <span>видалення</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][3]) ? "checked" : ""; ?> name="right3" value="1">

      </div>
      <div class="type">
        <p>Студент: </p>
        <span>перегляд</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][4]) ? "checked" : ""; ?> name="right4" value="1">
        <span>створення</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][5]) ? "checked" : ""; ?> name="right5" value="1">
        <span>редагування</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][6]) ? "checked" : ""; ?> name="right6" value="1">
        <span>видалення</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][7]) ? "checked" : ""; ?> name="right7" value="1">

      </div>
      <div class="type">
        <p>Користувачі: </p>
        <span>адміністрування</span>
        <input type="checkbox" <?php echo ("1" == $user['rights'][8]) ? "checked" : ""; ?> name="right8" value="1">

      </div>
    </div>
    <div><input type="submit" class="submit" name="ok" value="змінити"></div>
  </form>
</body>

</html>