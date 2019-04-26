<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 19.05.14
 * Time: 20:37
 */
include('../../classes/autoloadClasses.php');

$year = substr($_GET['w'],0,4);
$week = substr($_GET['w'],6);
$journal = new journal($_GET['g']);
$lessons = $journal->getLessonsForWeek($week,$year);
//$lessons = $journal->getLessonsForWeekGroupByTimeAndDate($week,$year);
if (is_null($lessons)) {
    print '<h4><b>Расписание на эту неделю не заполнено!</b></h4>';
    return;
}
print '<table class="tables">
            <thread>
                <tr>';
//print '             <th>Час</th>';
for($i = 0, $print = true;$i < 7;$i++, $print = true)
{
    $date = text::getDayWeek($week,$year,$i);
    foreach ($lessons['weekend'] as $row) {
        if ($date == $row) {
            $print = false;
            break;
        }
    }
    if ($print)
        print '<th>'.text::dayWeekOnNumDayWeek($i+1).'<br>'.$date.'</th>';
}
print'          </tr>
            </thread>
            <tbody>';

for ($i = 0; $i < $lessons['maxInDay']/*count($lessons['hour'])*/; $i++)
{
    print '<tr>';
    //print '<td>'.$lessons['hour'][$i].':00</td>';
    for ($j = 0; $j < 7; $j++)
    {
        //Убираем выходные из таблицы
        $print = true;
        foreach ($lessons['weekend'] as $row) {
            if (text::getDayWeek($week,$year,$j) == $row) {
                $print = false;
                break;
            }
        }
        if (!$print) {continue;}
        /////////////////////////////
        if (count($lessons[$j])-1 < $i) {
            print '<td></td>';
            continue;
        }


        print '<td>';
        print $lessons[$j][$i]->time.' - '.$lessons[$j][$i]->getDiscipline()->name;

        /*if ($lessons[$i][$j] != null) {
            foreach ($lessons[$i][$j] as $key=>$row) {
                print $row->time.' - '.$row->getDiscipline()->name;
                if ($key + 1 < count($lessons[$i][$j])) {
                    print '<br>';
                }
            }
        }*/
        print '</td>';
    }
    print '</tr>';
}
print '     </tbody>
        </table>';
print '<H4><b>*Выходные дни: ';
foreach ($lessons['weekend'] as $key=>$w) {
    print text::dayWeekOnNumWithSunday(text::parseDate($w,'w')).'('.$w.')';
    if ($key + 1 < count($lessons['weekend'])) {
        print ', ';
    } elseif ($key + 2 < count($lessons['weekend'])) {
        print ' и ';
    }
}
print '.</b></H4>';