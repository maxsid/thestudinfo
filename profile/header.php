	<?php
    $welcome = $my->getFullName(true,false,false);
print <<<HERE

	<div class="inHeader">
		<div class="mosAdmin">
		Приветствую, $welcome<br>
		<a href="/support/client.php?locale=ru" target="_blank" 
		onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; 
		window.event.preventDefault) window.event.preventDefault();
		this.newWindow = window.open(&#039;/support/client.php?locale=ru&amp;url=&#039;
		+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), 
		'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');
		this.newWindow.focus();this.newWindow.opener=window;return false;">Помощь</a> | 
		<a href="/exit.php">Выйти</a>
		</div>
	<div class="clear"></div>
	</div>
	
HERE;
?>