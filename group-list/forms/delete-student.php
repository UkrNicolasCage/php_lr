<?php
include(__DIR__ . '/../auth/check-auth.php');
if (!CheckRight('student', 'delete')) {
  die('Ви не маєте права на виконання цієї інформації');
}
unlink("/var/www/public/files/group-list/data/" . $_GET['group'] . "/" . $_GET['file']);
header('Location: ../index.php?group=' . $_GET['group']);
