<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/classes/autoload.php');
print '<div id="header">';
include($root . '/profile/header.php');

print '</div><div id="wrapper">';

include($root . '/profile/leftblock.php');
print '

         <div id="rightContent">
        <h3>' . $my->getFullName() . '</h3>
	    <h4>Группа ' . $my->getGroup() . '</h4>
	     </div>
		 <div id="news_dvig">
         <h3>Входящие сообщения</h3>
         </div>
		  <div id="news_dvig_menu">
         <ul>
		 <li><a style="background-image:url(../../styles/img/mail.png)" href="incoming.php">Входящие</a></li>
		 <li><a style="background-image:url(../../styles/img/sent_mail.png)" href="outcoming.php">Исходящие</a></li>
		 <li><a style="background-image:url(../../styles/img/new_mail.png)" href="new.php">Новое сообщение</a></li>
		 </ul>
         </div>
		 <div id="rightContent">
		 		 <div class="otstup_news">

		 ';
if (!empty($_POST['title']) and !empty($_POST['recipients']) and !empty($_POST['editor'])) {
    $mes = new message();
    $mes->fullForSend($my->id, $_POST['title'], $_POST['editor'], $_POST['recipients']);
    if ($mes->sendMessages()) {
        exit('Сообщение успешно отправлено!
		</div></div>
		    <div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
</div></div></div>');
    };
} elseif (isset($_POST['buttonOk'])) {
    print 'Вы не заполнили нужные поля!';
}

print '<form method="POST">
<h5>Заголовок сообщения(макс. 40 символов):</h5>
<input class="inputi"  type="text" name="title" value="" size="112px" maxlength="40" autocomplete="off">';
print '<table>
            <tr>
                <td><h5>Получатели:</h5> <select name="recipients[]" size="5" multiple="multiple">';
//////////////////////////////////
$inst = new institut($my->institut);
$groups = $inst->getGroupsInstitut(true,true);
foreach ($groups as $gr) {
    if (count($gr->users) > 0) {
        print '<OPTGROUP label="' . $gr->name . '">';
        foreach ($gr->users as $user) {
            if ($user->id != $my->id)
                print '<option value="' . $user->id . '" label="' . $user->getGroup() . '" >' . $user->getFullName(false) . '</option>';
        }
        print '</OPTGROUP>';
    }
}
$admin = $inst->getAdministration();
if (count($admin) > 0) {
    print '<OPTGROUP label="Администрация">';
    foreach ($admin as $user) {
        print '<option value="' . $user->id . '" label="Администрация" >' . $user->getFullName() . '</option>';
    }
    print '</OPTGROUP>';
}
unset($inst);
/////////////////////////////////
print '</select>
                </td>
                <td valign="top">';
include($root . '/elements/searchOnList.php');
print '         </td>
            </tr>
        </table><br>';
print '<h5>Текст: </h5>
<textarea name="editor" id="editor1" cols="45" rows="5" value=""></textarea>
<script type="text/javascript">
   CKEDITOR.replace(\'editor\');
</script><br>
<button class="action greenbtn" float="right" type="submit" name="buttonOk"><span class="label">Отправить</span></button></div></div>
</form>	
    <div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
</div></div></div>';