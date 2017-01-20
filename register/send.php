<?
foreach ($_GET as $key=>$el) {
    $_GET[$key] = iconv('UTF-8', 'windows-1251', $_GET[$key]);
}
include_once('../classes/autoloadClasses.php');
$user = new user();
$user->name = $_GET['n'];
$user->lastname = $_GET['l'];
$user->patronymic = $_GET['p'];
$user->institut = (integer)$_GET['i'];
$user->student = $_GET['t'] === 'true' ? true:false;
if ($user->student) {
    $user->group = (integer)$_GET['g'];
}
$user->email = $_GET['e'];
print $user->register($_GET['d']);
