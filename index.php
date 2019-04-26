<?
require_once('classes/autoload.php');
$error_message = null;
if (!empty($_POST['login']) and !empty($_POST['password'])) {
    if ($my->authorization()) {
        header('Location: profile/');
    } else {
        $error_message = 'Неверный логин/пароль!<br>';
    }
} elseif (empty($_POST['login']) xor empty($_POST['password'])) {
    $error_message = 'Логин/пароль не введен!<br>';
}


?>

<!DOCTYPE html>

<html lang="ru">
<head>
    <meta http-equiv="Content-Type" charset="utf-8" content="text/html">
<head>
    <title>Главная studinfo</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="styles/css/home.css" type="text/css">
    <style>
        body {
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <script language="JavaScript">
        var randnum = Math.random();
        var inum = 26;
        var rand1 = Math.round(randnum * (inum - 1)) + 1;
        images = new Array
        images[1] = "styles/img/bg1.jpg"
        images[2] = "styles/img/bg2.jpg"
        images[3] = "styles/img/bg3.jpg"
        images[4] = "styles/img/bg4.jpg"
        images[5] = "styles/img/bg5.jpg"
        images[6] = "styles/img/bg6.jpg"
        images[7] = "styles/img/bg7.jpg"
        images[8] = "styles/img/bg8.jpg"
        images[9] = "styles/img/bg9.jpg"
        images[10] = "styles/img/bg10.jpg"
        images[11] = "styles/img/bg11.jpg"
        images[12] = "styles/img/bg12.jpg"
        images[13] = "styles/img/bg13.jpg"
        images[14] = "styles/img/bg14.jpg"
        images[15] = "styles/img/bg15.jpg"
        images[16] = "styles/img/bg16.jpg"
        images[17] = "styles/img/bg17.jpg"
        images[18] = "styles/img/bg18.jpg"
        images[19] = "styles/img/bg19.jpg"
        images[20] = "styles/img/bg20.jpg"
        images[21] = "styles/img/bg21.jpg"
        images[22] = "styles/img/bg22.jpg"
        images[23] = "styles/img/bg23.jpg"
        images[24] = "styles/img/bg24.jpg"
        images[25] = "styles/img/bg25.jpg"
        images[26] = "styles/img/bg26.jpg"
        var image = images[rand1]
    </script>
    <link rel="stylesheet" type="text/css" href="styles/css/jquery.arcticmodal-0.3.css"/>
    <link rel="stylesheet" type="text/css" href="styles/css/simple.css"/>
    <script src="http://yandex.st/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="styles/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" src="styles/js/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="styles/js/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="styles/js/jquery.arcticmodal-0.3.min.js"></script>
    <script type="text/javascript" src="styles/js/jquery.autocomplete.js"></script>
</head>
<body>
<script language="JavaScript">
    <!--
    Activate
    cloaking
    device
    document.write('<body background="' + image + '" text="white">')
    // Deactivate cloaking device -->
</script>

<div id="header">


    <div class="inHeader">
        <div class="clear"></div>
    </div>

</div>


<div class="page-root">

    <div class="home-grid">
        <?
        print '<div class="g-hidden-message_block">
    <div class="box-modal-message_block" id="exampleModal2">
<iframe width="900" height="400" src="//www.youtube.com/embed/tM1n-WduNu0" frameborder="0" allowfullscreen></iframe></div></div>';
        print '<div class="g-hidden-register">
    <div class="box-modal-register" id="exampleModal3">
        <div class="box-modal_close-register arcticmodal-close">закрыть</div>';
        include('register/index.php');
        print '</div></div>';
        print '
			<section id="home-intro" class="home-box" style="height: 365px;">
		<a onclick="$(\'#exampleModal2\').arcticmodal()" id="#example1">

					<strong><span>смотреть</span></strong>
					<h2>Презентация проекта для учебных заведений, где все подробно рассказывается.</h2>
				</a>
			</section>

			<section id="home-signup" class="home-box">
				<div>
					<h3>Вы хотите на новый уровень?</h3>
					<a onclick="$(\'#exampleModal3\').arcticmodal()" id="#example2" class="button button-highlighted">
						<h4>Подать заявку</h4>
					</a>
				</div>
			</section>
			';
        ?>
        <section id="home-signin" class="home-box">
            <div>
                <?php
                //if (!empty($_GET['admin']) && $_GET['admin'] == 'debug') {

                print '<h3>Хотите узнать успеваемость?</h3>

					<form method="post" novalidate="novalidate" id="login">
						<input type="text" name="login" placeholder="Ваш id" autocorrect="off" autocapitalize="off" spellcheck="false"';

                if (isset($_COOKIE['login'])) //есть ли переменная с логином в COOKIE. Должна быть, если пользователь при предыдущем входе нажал на чекбокс "Запомнить меня"
                {
//если да, то вставляем в форму ее значение. При этом пользователю отображается, что его логин уже вписан в нужную графу
                    echo ' value="' . $_COOKIE['login'] . '"';
                }

                print '>;
                <input type="password" name="password" placeholder="Ваш пароль"';
                if (isset($_COOKIE['password'])) //есть ли переменная с паролем в в COOKIE. Должна быть, если пользователь при предыдущем входе нажал на чекбокс "Запомнить меня"
                {
//если да, то вставляем в форму ее значение. При этом пользователю отображается, что его пароль уже вписан в нужную графу
                    echo ' value="' . $_COOKIE['password'] . '"';
                }

                print '>
                <input name="rememberme" id="rememberme" type="checkbox" value="forever" id="signin-rememberme"
                       checked="true">
                <label for="signin-rememberme" title="Запомнить меня">Запомнить</label>
                <input onclick="submit();" title="войти" type="submit" name="commit" value="Войти">
                <a class="password-help" href="">забыли?</a>
                </form>';
                /*}
                else {
                    print '<h3>Вход временно недоступен</h3>';

                }*/
                ?>
            </div>
        </section>

        <section id="home-discover" class="home-box">
            <div>
                <h3>Хотите узнать больше? Проконсультируйтесь со специалистом SFS GROUP.</h3>
                <a href="/support/client.php?locale=ru" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open(&#039;/support/client.php?locale=ru&amp;url=&#039;+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"
                   class="button button-primary">Вызвать специалиста</a>
            </div>
        </section>


    </div>

    <footer id="footer">
        <nav id="footer-navigation">
            <ul>
                <li id=""><a href="ссылка">Пользовательское соглашение</a></li>
                <li id=""><a href="ссылка">Как подключить колледж?</a></li>

            </ul>
            <a class="footer-sts" href="http://sfs.thestudinfo.ru/"></a>
        </nav>
    </footer>

</div>
</div>

</body>
</html>
