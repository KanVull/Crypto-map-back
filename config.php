<?php
$dblocation = "192.168.1.235";
//$dbname = "cabinet_test";
$dbname = "crypto_map";
$dbuser = "crypto_map";
$dbpasswd = "1@Fpqed5aJ";
$mysql=new mysqli($dblocation,$dbuser,$dbpasswd,$dbname);
$mysql->set_charset("utf8");
?>