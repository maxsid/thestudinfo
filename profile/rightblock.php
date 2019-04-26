    <?php
    $nameSpeciality = $my->student ? ' - '.$my->getObjectGroup()->speciality.' "'.$my->getObjectGroup()->getNameSpeciality().'"':'';
print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>Группа '.$my->getGroup().$nameSpeciality.'</h4>
	     </div>
		 
		 
		     <div id="rightContentNews">';

        include('../news/blocknews.php');//Блок с новостями
    ?>
<?php
print '
	 	     </div>
<div id="news_dvig">
   <h3>Ближайшие занятия</h3>
</div>
			 <div id="rightContent">
		<div class="clear"></div>	
';
    if ($my->student){
        include('statistics/past_lesson_for_student.php');
        include('statistics/after_lesson_for_student.php');
    } else {
        include('statistics/past_lesson_for_teacher.php');
        include('statistics/after_lesson_for_teacher.php');
    }
print '
		</div>

<div id="news_dvig">
   <h3>Управление группой</h3>
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
		<a href=""><img src="../styles/img/settings.png"><br>Настройки группы</a>
		</div>
		<div class="shortcutHome">
		<a href="/profile/message/new.php"><img src="../styles/img/bukutamu.png"><br>Сделать рассылку</a>
		</div>		</div>	
		
<div id="news_dvig">
   <h3>Последние сообщения</h3>
</div>		
	
';
	  
    				print '<div id="rightContent"> ';
  include('message/last_message.php');//Блок с сообщениями
	?>

	
	
	
	