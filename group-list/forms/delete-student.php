<?php
  unlink("/var/www/public/files/group-list/data/". $_GET['group'] ."/".$_GET['file']);
  header('Location: ../index.php?group=' . $_GET['group']);
?>