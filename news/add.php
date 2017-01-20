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
		 <div id="news_dvig">
         <h3>���������� ��������</h3>
         </div>
		 <div id="rightContent">
		 		 <div class="otstup_news">

		 ';

$news = new news();
$inst = new institut($my->institut);
    if (!empty($_POST['title']) and !empty($_POST['description']) and !empty($_POST['groups']))
    {
        $news->fillAdapterForAll($_POST['title'],$_POST['description'],$_POST['editor'],$my->id,$_POST['groups']);
        if ($news->saveData())
        {
            unset($_POST);
            $news->fillOnLatestNewsUser($my->id);
            echo "<html><head><meta http-equiv='Refresh' content='0; URL=view.php?i=".$news->id."'></head></html>";
            exit('������� ������� ���������!<br>������ ���������� ������� � �������.');
        } else
        {
            print '��������� ������! ������� �� ���������!';
        }
    } elseif (isset($_POST['buttonOk']))
    {
        print '���-�� �� �������!<br>���� ���������, �������� � ������ ����������� ��� ����������!';
    }

    print '<script type="text/javascript" src="../elements/WYSIWYG/ckeditor.js"></script>

<form method="POST">
<h5>��������� �������(����. 30 ��������):</h5>
<input class="inputi"  type="text" name="title" value="" size="112px" maxlength="30" autocomplete="off" required>
<h5>��������(����. 520 ��������): </h5>
<input class="inputi"  type="text" name="description" value="" size="112px" maxlength="300" autocomplete="off" required>
<br>';

//������� ������ � �����
print '';
print '<h5>������:</h5> <select id="s1" name="groups[]" size="5" multiple="multiple" required>';
$groups = $inst->getGroupsInstitut(true,false);
foreach ($groups as $group)
{
    print '<option value="'.$group->id.'" >'.$group->name.'</option>';
}
print '</select> <br>';

//���� ������
print '<h5>�����: </h5>
<textarea name="editor" id="editor1" cols="45" rows="5" value=""></textarea>
<script type="text/javascript">
   CKEDITOR.replace(\'editor\');
</script><br>
<button class="action greenbtn" float="right" type="submit" name="buttonOk"><span class="label">���������</span></button></div></div>
</form>
<div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">��������.��</a> <br>
</div>';
