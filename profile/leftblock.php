<div id="leftBar">

    <div class="ava">
        <img border="0" height="203" width="179" src="/profile/avatars/<? print $my->avatar; ?>"/>

        <div class="more"></div>
        <div class="desc">
            <center><strong onclick="showModalChangeAvatar();">������� ������</strong>
            </center>
        </div>
    </div>


    <ul>
        <li><a style="background-image:url(http://thestudinfo.ru/styles/img/profil.png)" href="/profile/">� �������</a>
        </li>
        <li><a style="background-image:url(http://thestudinfo.ru/styles/img/quote.png)"
               href="/profile/message/incoming.php">���������
                <? print $my->mail->countNewIncoming() > 0 ? '(' . $my->mail->countNewIncoming() . ' �����)' : ''; ?></a>
        </li>
        <li><a style="background-image:url(http://thestudinfo.ru/styles/img/rasp.png)" href="/journal/schedule/">����������</a>
        </li>
        <li><a style="background-image:url(http://thestudinfo.ru/styles/img/progress.png)" href="/journal/evaluation/">������</a>
        </li>
    </ul>
</div>
<script>
    function showModalChangeAvatar() {
        $.arcticmodal({
            type: 'ajax',
            url: 'avatars/download/index.php'
        });
    };
</script>

