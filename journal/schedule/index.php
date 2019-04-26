<?php
include_once('../../classes/autoload.php');
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
		 
		 include_once('groupsTabs.php');

    print '    <div id="news_dvig">
		 ';
if (is_null($_GET['w']))
{
    $_GET['w'] = date("Y").'-W'.date("W");
}
print '<input id="input4" type="week" name="week" value="'.$_GET['w'].'"><br>';
?>
</div>
	  <div id="rightContent">
				 		 <div class="otstup_news">
<div id="schedule"><? include('schedule.php'); ?></div>
<script>
    $('input[name="week"]').change(function() {
        $('#schedule').html('<H3>Loading...</H3>');
        $('#schedule').load('schedule.php?w=' + this.value + '&g=<? print $_GET['g']; ?>');
    })
</script>
<script type="text/javascript">
    try{
        var el=document.getElementById('msgText').getElementsByTagName('a');
        var url=document.location.href;
        for(var i=0;i<el.length; i++){
            if (url==el[i].href){
                el[i].className += ' act';
            };
        };
    }catch(e){}
</script>
<?
print '</div></div>
<div class="clear">
<div id="footer">
	&copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
</div></div></div>';