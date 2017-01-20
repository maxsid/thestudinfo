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
		 
		        <li>  <a href="">Заполнить расписание </a><br></li>
';
foreach ($groups as $key=>$g)
{
    if (is_null($_GET['g']))
    {
        if (is_null($my->group))
        {
            $back = $key == 0 ? 'bgcolor="red"' : '';
            $_GET['g'] = $groups[0].id;
        }
        else
        {
            $back = $my->group == $g->id ? 'bgcolor="red"' : '';
            $_GET['g'] = $my->group;
        }
    } else
    {
        $back = $_GET['g'] == $g->id ? 'bgcolor="red"' : '';
    }
    print '<li><a href="?g='.$g->id.'">'.$g->name.'</a></li>';
}

print ' </ul>
         </div>';