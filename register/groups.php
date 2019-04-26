<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 04.06.14
 * Time: 22:19
 */

include_once('../classes/autoloadClasses.php');
$db = new db();
if (empty($_GET['i'])) {
    return;
}
$_GET['query'] = iconv('UTF-8', 'utf-8', $_GET['query']);
$_GET['i'] = iconv('UTF-8', 'utf-8', $_GET['i']);
if ($_GET['query'] == "") {
    $query = "SELECT * FROM `studinfo`.`group` WHERE `institut` = '$_GET[i]';" ;
} else {
    $query = "SELECT * FROM `studinfo`.`group` WHERE `name` LIKE '%$_GET[query]%' AND `institut` = '$_GET[i]';";
}
$file = fopen("file.txt","a+");
fwrite($file,$query."\n");
fclose($file);

$res = $db->dArrayResult($query);
print '{';
print '"query":"'.$_GET['query'].'",';
print '"suggestions":[';
foreach ($res as $key=>$row){
    print '{"value":"'.$row['name'].'","id":"'.$row['id'].'"}';
    if ($key + 1 < count($res)) {
        print ', ';
    }
}
print ']';
print '}';



