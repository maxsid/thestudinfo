<?php
include_once('../../../../classes/autoloadClasses.php');
if (!empty($_GET['dn']) && !empty($_GET['dg']) && !empty($_GET['dt']) && !empty($_GET['da'])) {
    if(discipline::registerDiscipline($_GET['dn'],$_GET['dg'],$_GET['dt'],$_GET['da'])){
        print ('���������� ������� �������� � ����.');
    } else {
        print ('���������� �� ���������!');
    }
} else {print 'ups... ���-�� �� �����';}