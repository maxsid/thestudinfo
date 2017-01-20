<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/autoload.php');
print '<div id="header">';
include($root.'/profile/header.php');

print '</div><div id="wrapper">';
include($root.'/profile/leftblock.php');

print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>Группа '.$my->getGroup().'</h4>
	     </div>
		 <div id="news_dvig">
         <h3>Исходящие сообщения</h3>
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

if ($my->mail->countOutcoming() == 0)
{
    exit('Сообщений нет</div> </div>
<div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
</div> </div></div>
');
}

print '<table class="tables">
    <thead>
    <tr>
        <th width="30%">Получатели</th>
        <th width="53%">Заголовок</th>
        <th width="17%">Отправлено</th>
    </tr>
    </thead>
    <tbody>';

    $modalWindows = '';
	foreach ($my->mail->outcoming as $key=>$mes)
{
    $user = new user($mes->recipients[0]);
    $receipts = $user->getFullName(false,true);
    if (count($mes->recipients) > 1)
        $receipts .= " и еще ".(count($mes->recipients)-1);

    print ' <tr onclick="$(\'#exampleModal'.$key.'\').arcticmodal()" id="#example1">
                <td>'.$receipts.'</td>
                <td>'.$mes->title.'</td>
                <td>'.$mes->getDate().' в '.$mes->time.'</td>
            </tr>';

    ////////Открытое сообщение
    $modalWindows .=  '<div class="g-hidden-message">
    <div class="box-modal-message" id="exampleModal'.$key.'">
        <div class="box-modal_close-message arcticmodal-close">закрыть</div>
        <h3>'.$mes->title.'</h3><br>
        От кого: '.$my->getFullName(false).'<br>
        Кому: ';

    $group = $mes->recipients[0];
    foreach ($mes->recipients as $key=>$row)
    {
        $receipt = new user();
        $receipt->otherUser($row);
        $modalWindows .=  $receipt->getFullName(false,true);

        if ((count($mes->recipients) != $key+1))
            $modalWindows .=  ', ';
    }
    unset($group);
    $modalWindows .=  '<br>
        Получено '.$mes->getDate().' в '.$mes->time.'<br><br>
        '.$mes->message.'
		    </div>
</div>
';
}

print '    </tbody>
</table></div></div>'
;
print $modalWindows;
print '

<div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
</div> </div></div>
';
