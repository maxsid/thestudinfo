    <?php
print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>Группа '.$my->getGroup().'</h4>
	     </div>
		 
		 
		     <div id="rightContentNews">';

        include('../news/blocknews.php');//Блок с новостями
    ?>
<?php
print <<<HERE
	 	     </div>

		 
		<div id="rightContent">
		<div class="shortcutHome">
		<a href="/news/add.php"><img src="../styles/img/posting.png"><br>Добавить новость</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/photo.png"><br>Оценки</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/halaman.png"><br>Прогулы</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/template.png"><br>Состав группы</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/quote.png"><br>Настройки группы</a>
		</div>
		<div class="shortcutHome">
		<a href="/profile/message/new.php"><img src="../styles/img/bukutamu.png"><br>Сделать рассылку</a>
		</div>
				</div>

			<div id="rightContent">
		<div class="clear"></div>	
		<div id="smallRight"><h3>Общая информация</h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">Пропусков всего</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Средний результат группы среди других</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Средний балл в группе</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Лучший ученик группы</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Лучшая ученица группы</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Лучший в группе</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
		</table>
		</div>
		
		
		<div id="smallRight"><h3>Топ прогульщиков</h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">Ярослав Широкалов</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Ярослав Широкалов</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Ярослав Широкалов</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Ярослав Широкалов</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Ярослав Широкалов</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">Ярослав Широкалов</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			</table>
		</div>
HERE;
?>
	
	
	
	