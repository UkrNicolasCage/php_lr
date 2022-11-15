<?php
require '../auth/check-auth.php';
if (!CheckRight('user', 'admin')) {
  die('Ви не маєте права на виконання цієї інформації');
}
require '../data/declare-users.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../css/main-style.css">

  <title>Адміністрування</title>
</head>

<body>
  <header>
    <a href="../index.php">На головну</a>
    <h1>Адміністрування користувачів</h1>
  </header>
  <section>
    <table class="table users-table">
      <thead>
        <tr>
          <th>Користувач</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['users'] as $user) : ?>
          <?php if ($user['name'] !=  $_SESSION['user'] && $user['name'] != 'admin' && trim($user['name']) != '') : ?>
            <tr>
              <td>
                <a href="edit-user.php?username=<?php echo $user['name']; ?>">
                  <?php echo $user['name']; ?>
                </a>
              </td>
            </tr>
          <?php endif ?>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</body>

</html>