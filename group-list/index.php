<?php
require('/var/www/public/files/group-list/auth/check-auth.php');
require('/var/www/public/files/group-list/data/declare-groups.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/gender-style.css">

  <link rel="stylesheet" href="/css/edit-group-form-style.css">
  <link rel="stylesheet" href="./css/main-style.css">

  <title>Список групи</title>
</head>

<body>
  <header>
    <div class="user-info">
      <span>Hello <?php echo $_SESSION['user']; ?> !</span>
      <a href="auth/logout.php">Logout</a>
    </div>
    <?php if (CheckRight('group', 'view')) : ?>
      <form method='GET' name='group-form'>
        <label for="group">Група</label>
        <?php $data['groups'][1][1]; ?>
        <select name="group">
          <?php
          foreach ($data['groups'] as $curgroup) {
            echo "<option " . (($curgroup['file'] == $_GET['group']) ? "selected" : "") . " value=" .
              $curgroup['file'] . " >" . $curgroup['number'] . "</option>";
          }
          ?>
        </select>
        <input type="submit" value="ok">
        <?php if (CheckRight('group', 'create')) : ?>
          <a href="forms/create-group.php">Додати групу</a>
        <?php endif; ?>
      </form>



      <?php if ($_GET['group']) : ?>
        <?php
        $groupFolder = $_GET['group'];
        require('/var/www/public/files/group-list/data/declare-data.php')
        ?>
        <h1>Список групи <span><?php echo $data["group"]["number"]; ?></span></h1>
        <h2>староста <span><?php echo $data["group"]['starosta']; ?></span></h2>
        <h3>Факультет: <span><?php echo $data["group"]['departmemt']; ?></span></h3>
        <div class="controls">
          <?php if (CheckRight('group', 'edit')) : ?>
            <a href="forms/edit-group.php?group=<?php echo $_GET['group']; ?>">Редагувати групу</a>
          <?php endif; ?>
          <?php if (CheckRight('group', 'delete')) : ?>
            <a href="forms/delete-group.php?group=<?php echo $_GET['group']; ?>">Видалити групу</a>
          <?php endif; ?>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </header>
  <?php if (CheckRight('student', 'view')) : ?>
    <section>
      <?php if ($_GET['group']) : ?>
        <?php if (CheckRight('student', 'create')) : ?>
          <div class="controls">
            <a href="forms/create-student.php?group=<?php echo $_GET['group']; ?>"> Додати Студента </a>
          </div>
        <?php endif; ?>
        <form method="POST">
          <label for="name-filter">Фільтрувати за прізвищем</label>
          <input type="text" name="name-filter" value="<?php echo $_POST['name-filter'] ?>">
          <input type="submit" value="фільтрувати">
        </form>

        <table class="table" style="width: 70%;">
          <thead>
            <th>№ п.п.</th>
            <th>Прізвище</th>
            <th>Стать</th>
            <th>Рік народження</th>
            <th></th>
          </thead>
          <tbody>
            <?php foreach ($data['students'] as $key => $student) : ?>
              <?php if (!$_POST['name-filter'] || stristr($student['name'], $_POST['name-filter'])) :  ?>
                <tr class=<?php echo $student['gender'] == 'чол' ? 'student-boy' : 'student-girl' ?>>
                  <td><?php echo ($key + 1); ?></td>
                  <td><?php echo $student["name"]; ?></td>
                  <td><?php echo $student["gender"]; ?></td>
                  <td><?php
                      $date_of_birth = new DateTime($student['dob']);
                      echo date_format($date_of_birth, 'Y');
                      ?></td>

                  <td>
                    <?php if (CheckRight('student', 'edit')) : ?>
                      <a href="forms/edit-student.php?group=<?php echo $_GET['group']; ?>&file=<?php
                                                                                                echo $student['file'];
                                                                                                ?>">Редагувати</a>
                      <?php endif; ?>|
                      <?php if (CheckRight('student', 'delete')) : ?>
                        <a href="forms/delete-student.php?group=<?php echo $_GET['group']; ?>&file=<?php
                                                                                                    echo $student['file'];
                                                                                                    ?>">Видалити</a>
                        <?php endif; ?>|
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </section>
  <?php endif; ?>
</body>

</html>