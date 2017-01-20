<? include_once('classes/autoload.php'); ?>
<form name=anketa method="post" action="mailto:vasya@mail.ru">
    <b>Ф.И.О.</b><br>
    <input type=text name="fio" size=37 maxlength=100><br><br>
    <b>Вы:</b>
    Мужчина<input type=radio name="sex" value="мужчина"> Женщина<input type=radio name="sex" value="женщина"><br><br>
    <b>Какие фильмы вы любите смотреть?</b><br>
    <input type=checkbox name="fiction" value="yes"> фантастику<br>
    <input type=checkbox name="thriller" value="yes"> боевики<br>
    <input type=checkbox name="adventure" value="yes"> приключенческие<br>
    <input type=checkbox name="melodrama" value="yes"> мелодрамы<br>
    <input type=checkbox name="documentary" value="yes"> документальные<br>
    <br>
    <b>Из этих актеров вам больше нравится:</b><br>
    <select name="actor" size="4">
        <option value="gorez">Гордый Горец
        <option value="rembo">Недоделанный Рембо
        <option value="cowboy">Ковбой В Шляпе
        <option value="crybobby">Слезливый Бобби
        <option value="history">Историческая личность
    </select><br><br>
    <b>В какую страну вы хотели бы поехать?</b><br>
    <select name="country">
        <option value="france">Франция
        <option value="USA">США
        <option value="england">Англия
        <option value="italy">Италия
        <option value="australia">Австралия
    </select><br><br>
    <b>Ваш е-майл:</b><br>
    <input type=text name="email" size=37 maxlength=80 value="@"><br><br>
    <input type=submit value="Отправить анкету"><input type=reset value="Отмена">
</form>