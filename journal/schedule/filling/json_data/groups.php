<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 24.05.14
 * Time: 23:00
 */
include_once('../../../../classes/autoloadClasses.php');
$_GET['query'] = iconv('UTF-8', 'windows-1251', $_GET['query']);

