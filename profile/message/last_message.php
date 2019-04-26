<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 29.05.14
 * Time: 20:47
 */
$last_message = $my->mail->incoming;
print '<table class="tables">';
if (count($last_message) == 0){
    print '<tr><td>Сообщений нет!</td></tr>';
} else {
    $modalWindows = '';
    foreach ($last_message as $key=>$mes)
    {
        $author = new user();
        $author->otherUser($mes->author);
        $mes->setReading($my->id);
        print ' <tr onclick="$(\'#exampleModal'.$key.'\').arcticmodal()" id="#example1">
                <td>'.$author->getFullName(false,true).'</td>
                <td>'.$mes->title.'</td>
                <td>'.$mes->getDate().' в '.$mes->time.'</td>
            </tr>';
        $modalWindows .=  '<div class="g-hidden-message">
    <div class="box-modal-message" id="exampleModal'.$key.'">
        <div class="box-modal_close-message arcticmodal-close">закрыть</div>
        <h3>'.$mes->title.'</h3><br>
        От: '.$author->getFullName(false).'<br>
        Кому: ';

        $group = $mes->recipients[0];
        foreach ($mes->recipients as $key0=>$row)
        {
            $receipt = new user();
            $receipt->otherUser($row);
            $modalWindows .= $receipt->getFullName(false,true);

            if ((count($mes->recipients) != $key0+1))
                $modalWindows .=  ', ';
        }
        unset($group);
        $modalWindows .=  '<br>
        Получено '.$mes->getDate().' в '.$mes->time.'<br><br>
        '.$mes->message.'
    </div>
</div>';
        if ($key > 5) { break; }
    }
}
print '</table>';
print $modalWindows;