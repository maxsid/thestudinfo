<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="http://thestudinfo.ru/styles/js/avajs.js"></script>
<link rel="stylesheet" type="text/css" href="http://thestudinfo.ru/styles/css/avaslyle.css" />
</head>
<body>
<div class="content">
  <div class="box-modal_close-register arcticmodal-close">закрыть</div>
  <h1>Загрузка новой фотографии</h1>
<center>Пользователям будет проще узнать Вас, если Вы загрузите свою настоящую фотографию.
Вы можете загрузить изображение в формате JPG, GIF или PNG.</center>

        <form id="frm">
		<div class="container upload">  
		<span class="btn">Загрузить аватар</span>  
		<input style = 'cursor: pointer;' type="file" id="uploadbtn"/></div>  
        </form>
    <!-- Область предпросмотра -->
	<div id="uploaded-holder"> 
		<div id="dropped-files">
        	<!-- Кнопки загрузить и удалить, а также количество файлов -->
        	<div id="upload-button">
                	<span>0 Файлов</span>
					<a href="#" class="upload">Загрузить</a>
					<a href="#" class="delete">Удалить</a>
                    <!-- Прогресс бар загрузки -->
                	<div id="loading">

						<div id="loading-content"></div>
					</div>
			</div>  
        </div>
	</div>
	<!-- Список загруженных файлов -->
	<div id="file-name-holder">
		<ul id="uploaded-files">
			<h1>Файл загружен</h1>
		</ul>
	</div>
</div>
<style>
.container {
width:150px;
margin:20px auto 0;
height:50px;
}
.upload {
position:relative;
}
.upload > input[type=file] {
display:block;
width:100%;
height:100%;
opacity:0;
}
.upload > .btn {
position:absolute;
top:0;
left:0;
width:100%;
height:100%;
background: #3A8E00;
background: -webkit-linear-gradient(top, #3C9300, #398A00);
background: -moz-linear-gradient(top, #3C9300, #398A00);
background: -ms-linear-gradient(top, #3C9300, #398A00);
background: -o-linear-gradient(top, #3C9300, #398A00);
-webkit-transition: border .20s;
-moz-transition: border .20s;
-o-transition: border .20s;
transition: border .20s;
color: #FFF !important;
font-family: Helvetica, Arial, sans-serif;
text-shadow: 0 1px 0 #2D6200 !important;
font-size:14px;
font-weight:bold;
border:solid 1px #ddd;
border: 1px solid #29691D !important;
text-align:center;
line-height: 50px;
z-index:0;
}
.upload:hover > .btn {
    border: 1px solid #2D6200 !important;
	background: #3F83F1;
	background: -webkit-linear-gradient(top, #3C9300, #368200);
	background: -moz-linear-gradient(top, #3C9300, #368200);
	background: -ms-linear-gradient(top, #3C9300, #368200);
	background: -o-linear-gradient(top, #3C9300, #368200);
}
</style>
</body>
</html>