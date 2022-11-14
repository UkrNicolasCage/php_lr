<?php
$f = fopen("/var/www/public/files/group-list/data/" . $groupFolder . "/group.txt", "r");
$grStr = fgets($f);
$grArr = explode(",", $grStr);
fclose($f);

$data["group"] = array(
  'number' => $grArr[0],
  'starosta' => $grArr[2],
  'departmemt' => $grArr[1],
);
?>