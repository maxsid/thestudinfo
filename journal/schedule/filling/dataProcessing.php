<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 07.05.14
 * Time: 23:10
 */
include_once('../../../classes/autoload.php');
$week = substr($_POST['week'],6);
$year = substr($_POST['week'],0,4);
$countPair = 0;
$errorPair = 0;
$journal = new journal($_POST['group']);
for ($i = 0;$i < 6;$i++)
{
    $date = text::getDayWeekForDB($week,$year,$i);
    for ($j = 0;$j < 5; $j++)
    {
        if ($_POST['time'][$i][$j] != null)
        {
            if ($journal->addLesson($date . " " . $_POST['time'][$i][$j] . ":00",$_POST['disciplineId'][$i][$j],
            $_POST['teacherId'][$i][$j],$_POST['audience'][$i][$j],$_POST['description'][$i][$j],$_GET['g']))
            {
                $countPair += 1;
            } else
            {
                $errorPair += 1;
            };
        }
    }
}

$countPair .= $countPair < 5 ? " занятия" : " занятий";
$errorPair = $errorPair > 0 ? $countPair . " не добавлено" : "";
header('Location: ../../schedule/?w='.$_POST['week']);
print "Успешно добавлено ".$countPair." в расписание. " . $errorPair;