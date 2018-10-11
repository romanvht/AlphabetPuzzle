<?php
header('Access-Control-Allow-Origin: *');
include_once 'inc/db.php';
include_once 'inc/func.php';

$name = in_t($_POST['name']);
$size = int($_POST['size']);
$score = int($_POST['score']);
$win = int($_POST['win']);
if(!empty($name) && !empty($size) && !empty($score))
$vht->query("INSERT INTO `2048` (`name`, `size`, `score`, `win`, `time`) VALUES ('$name', '$size', '$score', '$win', '".time()."')");
exit();