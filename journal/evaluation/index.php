<?php
/**
 * Created by PhpStorm.
 * User: ������ �������
 * Date: 27.05.14
 * Time: 21:53
 */
header("Location: filling/");
include_once('../../classes/autoload.php');
print '<div id="header">';
include($root.'/profile/header.php');

print '</div><div id="wrapper">';
include($root.'/profile/leftblock.php');

print '
         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>������ '.$my->getGroup().'</h4>
	     </div>
		  ';
include('groupsTabs.php');
include('modeTabs.php');
print '<div id="rightContent">'; ?>
<H3>�������� �� ��������.<br>�� �������� ���� ���������.</H3>



<?print '</div></div>
<div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">��������.��</a> <br>
</div></div></div>';