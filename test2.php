<? include_once('classes/autoload.php'); ?>
<form name=anketa method="post" action="mailto:vasya@mail.ru">
    <b>�.�.�.</b><br>
    <input type=text name="fio" size=37 maxlength=100><br><br>
    <b>��:</b>
    �������<input type=radio name="sex" value="�������"> �������<input type=radio name="sex" value="�������"><br><br>
    <b>����� ������ �� ������ ��������?</b><br>
    <input type=checkbox name="fiction" value="yes"> ����������<br>
    <input type=checkbox name="thriller" value="yes"> �������<br>
    <input type=checkbox name="adventure" value="yes"> ���������������<br>
    <input type=checkbox name="melodrama" value="yes"> ���������<br>
    <input type=checkbox name="documentary" value="yes"> ��������������<br>
    <br>
    <b>�� ���� ������� ��� ������ ��������:</b><br>
    <select name="actor" size="4">
        <option value="gorez">������ �����
        <option value="rembo">������������ �����
        <option value="cowboy">������ � �����
        <option value="crybobby">��������� �����
        <option value="history">������������ ��������
    </select><br><br>
    <b>� ����� ������ �� ������ �� �������?</b><br>
    <select name="country">
        <option value="france">�������
        <option value="USA">���
        <option value="england">������
        <option value="italy">������
        <option value="australia">���������
    </select><br><br>
    <b>��� �-����:</b><br>
    <input type=text name="email" size=37 maxlength=80 value="@"><br><br>
    <input type=submit value="��������� ������"><input type=reset value="������">
</form>