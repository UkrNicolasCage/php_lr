<?php
$nameTpl = '/^group-\d\d\z/';
$path = "/var/www/public/files/group-list/data/";
$const = scandir($path);
$i = 0;
foreach ($const as $node) {
  if (preg_match($nameTpl, $node)) {
    $last_group = $node;
  }
}

$group_index = (string)((int)substr($last_group, -1, 2) + 1);
if (strlen($group_index) == 1) {
  $group_index = "0" . $group_index;
}
$newGroupName = "group-" . $group_index;


mkdir("/var/www/public/files/group-list/data/" . $newGroupName);
$f = fopen("/var/www/public/files/group-list/data/" . $newGroupName . "/group.txt", "w");
fwrite($f, "New; ; ");
fclose($f);
header('Location: ../index.php?group=' . $newGroupName);
