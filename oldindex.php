<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=WINDOWS-1251" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="styles/css/main.css"/>
<link rel="stylesheet" type="text/css" href="styles/js/ie7/skin.css"/>
<script type="text/javascript" src="styles/js/jquery.js"></script>
<script type="text/javascript" src="styles/js/main-menu.js"></script>
<script type="text/javascript" src="styles/js/spoiler.js"></script>
<script type="text/javascript" src="styles/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="styles/js/jquery.uniform.min.js"></script>
<script type="text/javascript" charset="utf-8">
      $(function(){
        $("input:radio, input:file, textarea, select").uniform();
      });
    </script>


<style>
#index {
	position: absolute;
	width: 900px;
	left: 50%;
	top: 50%;
	color: #FFFFFF;
	text-align: center;
	margin-left: -450px;
	text-shadow: 1px 1px 1px #000000;
}
#index2 {
	position: absolute;
	width: 900px;
	left: 50%;
	top: 55%;
	color: #FFFFFF;
	text-align: center;
	margin-left: -450px;
	text-shadow: 1px 1px 1px #000000;
}
#title {
	font-size: 36px;
	font-weight: bold;
	padding: 10px;
}
#cont {
	font-size: 20px;
	padding: 10px;
}
#tel {
	font-size: 26px;
	padding: 10px;
}
</style>

</head>

<body>
<!--[if lte IE 7]><div class="content-ie"><img src="styles/img/logo-ie.gif"/><br/><br/>�� ����������� ���������� �������!<div style="font-size: 12px">
���� win-beta �� ������������ �������� Internet Explorer ���� ������ 8. ����������, �������� ��� �������.</div><br/>
<a href="http://windows.microsoft.com/ru-RU/internet-explorer/downloads/ie"><img src="styles/img/icon-ie-ie.gif"/></a>&nbsp;<a href="http://www.opera.com/download/get.pl?id=33829&thanks=true&sub=true"><img src="styles/img/icon-ie-o.gif"/></a>&nbsp;<a href="http://www.mozilla.org/ru/firefox/"><img src="styles/img/icon-ie-moz.gif"/></a>&nbsp;<a href="http://www.google.ru/chrome"><img src="styles/img/icon-ie-webkit1.gif"/></a>&nbsp;<a href="http://www.apple.com/ru/safari/download/"><img src="styles/img/icon-ie-webkit2.gif"/></a><br/>
<a href="http://windows.microsoft.com/ru-RU/internet-explorer/downloads/ie-8">��� IE 8 ��� Windows XP</a>
</div>  <div style="display:none"><![endif]-->
<div class="ololo"><a href="#menu" class="win-beta2"></a></div>
<script type="text/javascript"> 
$('.win-beta2').openDOMWindow({ 
eventType:'click', 
loader:0, 
borderSize:'0',
overlayColor:'#260930',
overlayOpacity:'null',
windowBGColor:'null',
width:1000,
height:500
}); 
</script> 



<div id="index">
  <div id="title">StudInfo �������������� ���� ��� ���������</div>
  <div id="tel">tel: <strong>+7 (908) 235-08-69</strong>&nbsp;&nbsp;|&nbsp;&nbsp;mail: <strong>admin@thestudinfo.ru</strong></div>
<div id="cont">Coming soon.</div></div>

<div id="menu" style=" display:none;"> 
<p>

<table cellpadding="0" cellspacing="0" border="0">
<tr style="vertical-align: top;">
<td>
<a href="#" class="closeDOMWindow"></a>
</td>
<td><img style="margin-top: 12px;" src="styles/img/login-logo.png" alt="����"/></td>
</tr>
<tr>
<td></td>
<td>
<form action="/profile/authorization.php" method="post">
<div style="margin-top: 50px;" class="login-text">������� ��� �����:</div>
<input class="login-form" type="text" name="login" value="" placeholder="�����"
<?php
	
if (isset($_COOKIE['login'])) //���� �� ���������� � ������� � COOKIE. ������ ����, ���� ������������ ��� ���������� ����� ����� �� ������� "��������� ����"
{
//���� ��, �� ��������� � ����� �� ��������. ��� ���� ������������ ������������, ��� ��� ����� ��� ������ � ������ �����
echo ' value="'.$_COOKIE['login'].'"';
}
?>
>
<br>
<div style="margin-top: 10px;" class="login-text">� ������: (<a href="#">��������������</a>)</div>
<input class="login-form" type="password" name="password" value="" placeholder="������" 

<?php
if (isset($_COOKIE['password']))//���� �� ���������� � ������� � � COOKIE. ������ ����, ���� ������������ ��� ���������� ����� ����� �� ������� "��������� ����"
{
//���� ��, �� ��������� � ����� �� ��������. ��� ���� ������������ ������������, ��� ��� ������ ��� ������ � ������ �����
echo ' value="'.$_COOKIE['password'].'"';
}
?>
>
<br>
<div style="margin-top: 10px;" class="login-text"><label><input class="login-check" type="checkbox" />����� ���������</label></div>
<button class="login-button" onclick="submit();" type="submit" name="commit" title="����">����</button>
 </form>
</td>
</tr>
</table>
</p>
</div>

<!--[if lte IE 7]></div><![endif]-->
</body>

</html>