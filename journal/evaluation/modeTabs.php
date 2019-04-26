<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 12.05.14
 * Time: 21:02
 */
print '<div id="news_dvig_menu">
         <ul>
         <li><a href="/journal/evaluation/filling/">Заполнить</a></li>';

if ($_GET['m']=='schedule' or empty($_GET['m'])) {
    print '<li class="active">';
    $_GET['m'] = 'schedule';}
else {print '<li>';};
print '<a href="?g='.$_GET['g'].'&m=schedule">Студенты/Расписание</a></li>';

if ($_GET['m'] == 'discipline') {
    print '<li class="active">';
} else { print '<li>';}
print '<a href="?g='.$_GET['g'].'&m=discipline">Студенты/Дисциплины</a></li>';
/*
if ($_GET['m']=='schedule') {
    print '<li class="active">';}
else {print '<li>';};
print '<a href="?g='.$_GET['g'].'&m=schedule">По расписанию</a></li>';*/


print'   </ul>
       </div>';