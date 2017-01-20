<?php
include_once('../../../../classes/autoloadClasses.php');
if (!empty($_GET['dn']) && !empty($_GET['dg']) && !empty($_GET['dt']) && !empty($_GET['da'])) {
    if(discipline::registerDiscipline($_GET['dn'],$_GET['dg'],$_GET['dt'],$_GET['da'])){
        print ('Дисциплина успешно занесена в базу.');
    } else {
        print ('Дисциплина не добавлена!');
    }
} else {print 'ups... Что-то не дошло';}