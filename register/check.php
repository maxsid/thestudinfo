<?
include_once('../classes/autoloadClasses.php');
if (!isset($_GET['u'])){
    exit('Произошла ошибка! Невозможно определить пользователя в базе.');
}

if (isset($_GET['b'])){
    $user = new user($_GET['u']);
    if ((boolean)$_GET['b']) {
        $user->confirmRegistration();
        exit('<h4>Регистрация принята</h4>');
    } else {
        $user->deleteRegisterUser();
        exit('<h4>В регистрации отказано</h4>');
    }
} else {
    if (user::checkUserId($_GET['u'])){
        $user = new user($_GET['u']);
        if ($user->confirmed){
            exit('<h4>Регистрация принята</h4>');
        } else {
            exit('
                    <a href="javascript:{}" onclick="$(\'#checkReg'.$_GET['u'].'\').html(\'Загрузка...\');$(\'#checkReg'.$_GET['u'].'\').load(\'/register/check.php?u='.$_GET['u'].'&b=1\')">Принять</a>
                    <a href="javascript:{}" onclick="$(\'#checkReg'.$_GET['u'].'\').html(\'Загрузка...\');$(\'#checkReg'.$_GET['u'].'\').load(\'/register/check.php?u='.$_GET['u'].'&b=0\')">Отклонить</a>');
        }
    } else {
        exit('<h4>В регистрации отказано</h4>');
    }
}