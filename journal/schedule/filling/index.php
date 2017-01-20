<?
include_once('../../../classes/autoload.php');
print '
<div class="g-hidden-message_block">
    <div class="box-modal-message" id="addDiscipline">
        <div class="box-modal_close-message arcticmodal-close">закрыть</div>';
        include_once('addDiscipline/index.php');
print '</div>
</div>
';
print '<div id="header">';
include($root.'/profile/header.php');

print '</div><div id="wrapper">';
include($root.'/profile/leftblock.php');

print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>Группа '.$my->getGroup().'</h4>
	     </div>
		  ';
include_once('../groupsTabs.php');
print '
        <div id="rightContent">
				 		 <div class="otstup_news">
		 ';

print '<form method="post" action="dataProcessing.php" onkeypress="return event.keyCode!=13">';
print '<input type="hidden" name="group" value="'.$_GET['g'].'"/>';
print '<input type="week" name="week" value="'.date("Y").'-W'.date("W").'" onchange="setDateOnDay()">';
for ($i = 0; $i < 7; $i++)
{
    print '<H3 class="label"></H3>';
    print '<table class="tables">';
    for ($j = 0; $j < 5; $j++)
    {
        print '
    <tr>
        <td width="5%"><input id="input3" type="time" name="time['.$i.']['.$j.']"/></td>
        <td width="40%"><input id="input3" class="discipline" type="text" name="discipline['.$i.']['.$j.']"/> <input type="hidden" name="disciplineId['.$i.']['.$j.']"/></td>
        <td width="20%"><input id="input3" class="teacher" name="teacher['.$i.']['.$j.']"/> <input type="hidden" name="teacherId['.$i.']['.$j.']"/></td>
        <td width="15%"><input id="input3" name="audience['.$i.']['.$j.']"/></td>
        <td width="20%"><input id="input3" name="description['.$i.']['.$j.']"/></td>
    </tr>';
    }
    print '</table>';
}
print '
<input type="submit">
        </form>';
?>
<script type="text/javascript" src="jquery.autocomplete.js"></script>
<script type="text/javascript" src="data.php?g=<? echo $_GET['g']; ?>"></script>
<script type="text/javascript" src="fillscript.js"></script>
<style>
    .container { width: 800px; margin: 0 auto; }

    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
</style>
</div></div>
<div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
</div></div></div>
