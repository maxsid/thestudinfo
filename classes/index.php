<?php
require_once('autoload.php');

$db = new db();

print $db->singleResult("SELECT `lastname` FROM `users` WHERE `id`=22;");