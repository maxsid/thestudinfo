<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 12.05.14
 * Time: 21:02
 */
$inst = new institut($my->institut);
$groups = $inst->getGroupsInstitut(true,false);
print '<div id="news_dvig_menu">
         <ul>
';
foreach ($groups as $key=>$g)
{
    if (is_null($_GET['g']) || $_GET['g'] <= 0)
    {
        if (is_null($my->group) || $_GET['g'] <= 0)
        {
            $back = $key == 0 ? 'class="active"' : '';
            $_GET['g'] = $groups[0]->id;
        }
        else
        {
            $back = $my->group == $g->id ? 'class="active"' : '';
            $_GET['g'] = $my->group;
        }
    } else
    {
        $back = $_GET['g'] == $g->id ? 'class="active"' : '';
    }
    print '<li '.$back.'><a href="?g='.$g->id.'&m='.$_GET['m'].'">'.$g->name.'</a></li>';
}

print ' </ul>
         </div>';