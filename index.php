<?
require_once('classes/autoload.php');
$error_message = null;
if (!empty($_POST['login']) and !empty($_POST['password'])) {
    if ($my->authorization()) {
        header('Location: profile/');
    } else {
        $error_message = '�������� �����/������!<br>';
    }
} elseif (empty($_POST['login']) xor empty($_POST['password'])) {
    $error_message = '�����/������ �� ������!<br>';
}


?>

<!DOCTYPE html>

<html lang="ru">
<head>
    <meta http-equiv="Content-Type" charset="windows-1251" content="text/html">
<head>
    <title>������� studinfo</title>
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
        <div class="box-modal_close-register arcticmodal-close">�������</div>';
        include('register/index.php');
        print '</div></div>';
        print '
			<section id="home-intro" class="home-box" style="height: 365px;">
		<a onclick="$(\'#exampleModal2\').arcticmodal()" id="#example1">

					<strong><span>��������</span></strong>
					<h2>����������� ������� ��� ������� ���������, ��� ��� �������� ��������������.</h2>
				</a>
			</section>

			<section id="home-signup" class="home-box">
				<div>
					<h3>�� ������ �� ����� �������?</h3>
					<a onclick="$(\'#exampleModal3\').arcticmodal()" id="#example2" class="button button-highlighted">
						<h4>������ ������</h4>
					</a>
				</div>
			</section>
			';
        ?>
        <section id="home-signin" class="home-box">
            <div>
                <?php
                //if (!empty($_GET['admin']) && $_GET['admin'] == 'debug') {

                print '<h3>������ ������ ������������?</h3>

					<form method="post" novalidate="novalidate" id="login">
						<input type="text" name="login" placeholder="��� id" autocorrect="off" autocapitalize="off" spellcheck="false"';

                if (isset($_COOKIE['login'])) //���� �� ���������� � ������� � COOKIE. ������ ����, ���� ������������ ��� ���������� ����� ����� �� ������� "��������� ����"
                {
//���� ��, �� ��������� � ����� �� ��������. ��� ���� ������������ ������������, ��� ��� ����� ��� ������ � ������ �����
                    echo ' value="' . $_COOKIE['login'] . '"';
                }

                print '>;
                <input type="password" name="password" placeholder="��� ������"';
                if (isset($_COOKIE['password'])) //���� �� ���������� � ������� � � COOKIE. ������ ����, ���� ������������ ��� ���������� ����� ����� �� ������� "��������� ����"
                {
//���� ��, �� ��������� � ����� �� ��������. ��� ���� ������������ ������������, ��� ��� ������ ��� ������ � ������ �����
                    echo ' value="' . $_COOKIE['password'] . '"';
                }

                print '>
                <input name="rememberme" id="rememberme" type="checkbox" value="forever" id="signin-rememberme"
                       checked="true">
                <label for="signin-rememberme" title="��������� ����">���������</label>
                <input onclick="submit();" title="�����" type="submit" name="commit" value="�����">
                <a class="password-help" href="">������?</a>
                </form>';
                /*}
                else {
                    print '<h3>���� �������� ����������</h3>';

                }*/
                ?>
            </div>
        </section>

        <section id="home-discover" class="home-box">
            <div>
                <h3>������ ������ ������? ������������������� �� ������������ SFS GROUP.</h3>
                <a href="/support/client.php?locale=ru" target="_blank" onclick="if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open(&#039;/support/client.php?locale=ru&amp;url=&#039;+escape(document.location.href)+&#039;&amp;referrer=&#039;+escape(document.referrer), 'mibew', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;"
                   class="button button-primary">������� �����������</a>
            </div>
        </section>


    </div>

    <footer id="footer">
        <nav id="footer-navigation">
            <ul>
                <li id=""><a href="������">���������������� ����������</a></li>
                <li id=""><a href="������">��� ���������� �������?</a></li>

            </ul>
            <a class="footer-sts" href="http://sfs.thestudinfo.ru/"></a>
        </nav>
    </footer>

</div>
</div>

</body>
</html>
