    <?php
    $nameSpeciality = $my->student ? ' - '.$my->getObjectGroup()->speciality.' "'.$my->getObjectGroup()->getNameSpeciality().'"':'';
print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>������ '.$my->getGroup().$nameSpeciality.'</h4>
	     </div>
		 
		 
		     <div id="rightContentNews">';

        include('../news/blocknews.php');//���� � ���������
    ?>
<?php
print '
	 	     </div>
<div id="news_dvig">
   <h3>��������� �������</h3>
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
   <h3>���������� �������</h3>
</div>		
		
		<div id="rightContent">
		<div class="shortcutHome">
		<a href="/news/add.php"><img src="../styles/img/posting.png"><br>�������� �������</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/photo.png"><br>������</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/halaman.png"><br>�������</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/template.png"><br>������ ������</a>
		</div>
		<div class="shortcutHome">
		<a href=""><img src="../styles/img/settings.png"><br>��������� ������</a>
		</div>
		<div class="shortcutHome">
		<a href="/profile/message/new.php"><img src="../styles/img/bukutamu.png"><br>������� ��������</a>
		</div>		</div>	
		
<div id="news_dvig">
   <h3>��������� ���������</h3>
</div>		
	
';
	  
    				print '<div id="rightContent"> ';
  include('message/last_message.php');//���� � �����������
	?>

	
	
	
	