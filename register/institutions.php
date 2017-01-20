<? include_once('../classes/autoloadClasses.php');
$_GET['query'] = iconv('UTF-8', 'windows-1251', $_GET['query']);
$institutions = globals::getAllInstitutions($_GET['query']);
print '{';
print '"query":"'.$_GET['query'].'",';
print '"suggestions":[';
foreach ($institutions as $key=>$inst) {
    print '{"value":"'.$inst->name.'","id":"'.$inst->id.'"}';
    if ($key + 1 < count($institutions)) {
        print ', ';
    }
}
print ']';
print '}';