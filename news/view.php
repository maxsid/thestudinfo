<?php
require_once('../classes/autoload.php');

print '<div id="header">';
include('../profile/header.php');

print '</div><div id="wrapper">';

include('../profile/leftblock.php');

print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>������ '.$my->getGroup().'</h4>
	     </div>

		 ';
		 
if (empty($_GET['i']))
{
    return;
}

$news = new news($_GET['i']);

if (!$news->hasAccess($my->group) or $news->text == null)
{
    exit("� ��� ��� ������� � ���� �������!");
}

$author = new user();
$author->otherUser($news->author);

print '<div id="news_dvig">
<H5>������������ '.$news->getDate().' � '.$news->time.'<br>
        �����: '.$author->getFullName(false,true).' ('.$author->getGroup().')</H5></div>';
print '<div id="rightContent"><H2>'.$news->name.'</H2></div><div id="rightContent"><div class="otstup_news">';
print $news->text;
print '</div></div><div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">��������.��</a> <br>
</div>';