    <?php
print '

         <div id="rightContent">
        <h3>'.$my->getFullName().'</h3>
	    <h4>������ '.$my->getGroup().'</h4>
	     </div>
		 
		 
		     <div id="rightContentNews">';

        include('../news/blocknews.php');//���� � ���������
    ?>
<?php
print <<<HERE
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
		<a href=""><img src="../styles/img/quote.png"><br>��������� ������</a>
		</div>
		<div class="shortcutHome">
		<a href="/profile/message/new.php"><img src="../styles/img/bukutamu.png"><br>������� ��������</a>
		</div>
				</div>

			<div id="rightContent">
		<div class="clear"></div>	
		<div id="smallRight"><h3>����� ����������</h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">��������� �����</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ��������� ������ ����� ������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ���� � ������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������ ������ ������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������ ������� ������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������ � ������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
		</table>
		</div>
		
		
		<div id="smallRight"><h3>��� ������������</h3>
		<table style="border: none;font-size: 12px;color: #5b5b5b;width: 100%;margin: 10px 0 10px 0;">
			<tr><td style="border: none;padding: 4px;">������� ���������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ���������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ���������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ���������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ���������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			<tr><td style="border: none;padding: 4px;">������� ���������</td><td style="border: none;padding: 4px;"><b>12</b></td></tr>
			</table>
		</div>
HERE;
?>
	
	
	
	