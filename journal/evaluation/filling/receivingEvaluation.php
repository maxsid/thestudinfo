<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 17.06.14
 * Time: 0:53
 */
include_once('../../../classes/autoload.php');
$firstUser = null;
foreach ($_POST as $key=>$ev){
    $firstUser = new user($key);
    break;
}
if ($my->student){
    $journal = new journal($firstUser->group);
} else {
    $journal = new teacherJournal($my->id);
}

$lessons = $journal->getPreviousLessons(0,false);

foreach ($_POST as $userId=>$evaluation){
    foreach($lessons as $key=>$les){
        $letter = substr($evaluation,$key,1);
        if ($letter == "y" || $letter == "Y" || $letter == "н"){
            $letter = "Н";
        }
        $les->addEvaluation($userId,$letter);
    }
}
header("Location: ../../../profile/");