<?
include_once('../../../classes/autoloadClasses.php');
$group = new group($_GET['g']);
$inst = $group->getInstitut();
$disciplines = $group->getDiscipline();
foreach ($disciplines as $key=>$d)
{
    $arrayDisciplines .= "{value:'".$d->name."',id:'".$d->id."',audience:'".$d->audience."',".
        "teacher:'".$d->getTeacher()->getFullName(true,true)."',teacherId:'".$d->getTeacher()->id."'"
        ."}";
    if ($key + 1 < COUNT($disciplines))
    {
        $arrayDisciplines.=',';
    }
}
if (strlen($arrayDisciplines) > 0)
echo "var discipline=[" . $arrayDisciplines . "];";


if (!empty($_GET['i'])) {
    $inst = new institut($_GET['i']);
}
$teachers = $inst->getTeacher();
$arrayTeachers = '';
foreach ($teachers as $key=>$t)
{
    $arrayTeachers.= "{value:'".$t->getFullName(true,true)."',id:'".$t->id."'}";
    if ($key + 1 < COUNT($teachers))
    {
        $arrayTeachers.=',';
    }
}
if (strlen($arrayTeachers) > 0)
    echo "var teachers=[" . $arrayTeachers . "];";
$groups = $inst->getGroupsInstitut(true, false);
$arrayGroups = '';
foreach ($groups as $key=>$group) {
    $arrayGroups.="{value:'".$group->name."',id:'".$group->id."'}";
    if ($key + 1 < COUNT($groups))
    {
        $arrayGroups.=',';
    }
}
if (strlen($arrayGroups) > 0)
    echo "var groups=[".$arrayGroups."];";