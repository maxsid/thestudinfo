<?
include_once('../classes/autoloadClasses.php');
if (!isset($_GET['u'])){
    exit('��������� ������! ���������� ���������� ������������ � ����.');
}

if (isset($_GET['b'])){
    $user = new user($_GET['u']);
    if ((boolean)$_GET['b']) {
        $user->confirmRegistration();
        exit('<h4>����������� �������</h4>');
    } else {
        $user->deleteRegisterUser();
        exit('<h4>� ����������� ��������</h4>');
    }
} else {
    if (user::checkUserId($_GET['u'])){
        $user = new user($_GET['u']);
        if ($user->confirmed){
            exit('<h4>����������� �������</h4>');
        } else {
            exit('
                    <a href="javascript:{}" onclick="$(\'#checkReg'.$_GET['u'].'\').html(\'��������...\');$(\'#checkReg'.$_GET['u'].'\').load(\'/register/check.php?u='.$_GET['u'].'&b=1\')">�������</a>
                    <a href="javascript:{}" onclick="$(\'#checkReg'.$_GET['u'].'\').html(\'��������...\');$(\'#checkReg'.$_GET['u'].'\').load(\'/register/check.php?u='.$_GET['u'].'&b=0\')">���������</a>');
        }
    } else {
        exit('<h4>� ����������� ��������</h4>');
    }
}