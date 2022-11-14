<?php
$nameTpl = '/^group-\d\d\z/';
$conts = scandir("data");

$i = 0;

foreach ($conts as $node) {
  if (preg_match($nameTpl, $node)) {
    $groupFolder = $node;
    require('/var/www/public/files/group-list/data/declare-group.php');

    $data['groups'][$i]['number'] = $data['group']['number'];
    $data['groups'][$i]['file'] = $groupFolder;
    $i++;
  }
}
