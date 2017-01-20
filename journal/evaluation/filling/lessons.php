<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 16.06.14
 * Time: 19:21
 */
include_once('../../../classes/autoloadClasses.php');
print "var lessons = [";
if (isset($_GET['u'])) {
    $journal = new teacherJournal($_GET['u']);
    $lessons = $journal->getPreviousLessons(0,false);
} elseif (isset($_GET['g'])) {
    $journal = new journal($_GET['g']);
    $lessons = $journal->getPreviousLessons(0,false);
}
$count = count($lessons);
if ($count != 0) {
    foreach ($lessons as $key => $les) {
        $teacher = $les->getTeacher();
        $teacher = $teacher->getName('L n. p.');

        $group = $les->getGroup();
        $group = $group->name;

        $discipline = $les->getDiscipline();
        $discipline = $discipline->name;

        print "{'id':'$les->id','teacher':'$teacher','group':'$group','discipline':'$discipline',".
            "'date':'$les->date','time':'$les->time'}";
        if ($key + 1 < $count){
            print ', ';
        }
    }
}
print "];";
print "var count = $count;";