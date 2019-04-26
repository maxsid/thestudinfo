<?php
session_start();
include_once('autoloadClasses.php');
$browser = new Browser();
if (!$browser->checkSupport()) {
    exit('<H3>Сожалеем, но ваш браузер не поддерживается.<br>Рекомендуем скачать последнию версию браузера:<br>
        <a href="https://www.google.ru/intl/ru/chrome/browser/">Google Chrome</a> |
        <a href="http://www.opera.com/ru">Opera</a>
        </H3>');
}

$my = new user();
$root = $_SERVER['DOCUMENT_ROOT']; //Корень сайта. В include и require пригодится
if ($_SERVER['REQUEST_URI'] != '/' and $_SERVER['REQUEST_URI'] != '/index.php') {
    if (!empty($_SESSION['login']) and !empty($_SESSION['password'])) {
        $my->mainUser($_SESSION['login'], $_SESSION['password']);
    } else {header("Location: /");}

    /*
     * Вместо
     * <script type="text/javascript" src="/styles/js/jquery.js"></script>
     * поставил
     * <script type="text/javascript" src="/styles/js/jquery-1.8.2.min.js"></script>
     * они конфликтовали.
     */
    print <<<HERE
<title>Студинфо.ру</title>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<link rel="stylesheet" type="text/css" href="/styles/css/main.css"/>
<link rel="stylesheet" type="text/css" href="/styles/css/gstyle_buttons.css"/>
<link rel="stylesheet" type="text/css" href="/styles/js/ie7/skin.css"/>
<link rel="stylesheet" type="text/css" href="/styles/css/jquery.arcticmodal-0.3.css"/>
<link rel="stylesheet" type="text/css" href="/styles/css/simple.css"/>
<link rel="stylesheet" type="text/css" href="/styles/css/table.css"/>
<script src="http://yandex.st/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/styles/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="/styles/js/main-menu.js"></script>
<script type="text/javascript" src="/styles/js/spoiler.js"></script>
<script type="text/javascript" src="/styles/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="/styles/js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="/styles/js/jquery.arcticmodal-0.3.min.js"></script>
<script type="text/javascript" src="/elements/WYSIWYG/ckeditor.js"></script>
<script type="text/javascript">
  var top_show = 150; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
  var delay = 1000; // Задержка прокрутки
  $(document).ready(function() {
    $(window).scroll(function () { // При прокрутке попадаем в эту функцию
      /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
      if ($(this).scrollTop() > top_show) $('#top').fadeIn();
      else $('#top').fadeOut();
    });
    $('#top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
      /* Плавная прокрутка наверх */
      $('body, html').animate({
        scrollTop: 0
      }, delay);
    });
  });
</script>
<div id="top"><img src="http://thestudinfo.ru/styles/img/naverh.png"></div>
<!-- Ниже список
<link rel="stylesheet" type="text/css" href="/styles/css/smoothness-1.8.13/jquery-ui-1.8.13.custom.css">
<link rel="stylesheet" type="text/css" href="/styles/css/ui.dropdownchecklist.themeroller.css">
<script type="text/javascript" src="/styles/js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="/styles/js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript" src="/styles/js/ui.dropdownchecklist.js"></script>
<script type="text/javascript" src="/styles/js/ui.dropdownchecklist-1.4-min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $("#s1").dropdownchecklist();
            }
</script>
-->
<script type="text/javascript" charset="utf-8">
    $(function(){
        $("input:checkbox, input:radio, input:file, textarea, select").uniform();
    });
</script>
HERE;

}




