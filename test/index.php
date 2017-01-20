<?
require_once('../classes/anubis.php');
require_once('../classes/text.php');
if (!empty($_POST)){
    $key = $_POST['key'];
    $text = $_POST['text'];
    $operation = $_POST['operation'];
    if (empty($key)){
        $key = text::generate(20);
    }
    if (!empty($text)){
            if (!empty($operation)){
                $anubis = new Anubis();
                $anubis->setKey($key);

                if ($operation == 'encode'){
                    $result = $anubis->encrypt($text);
                    $result2 = $anubis->decrypt($result);
                } elseif ($operation == 'decode'){
                    $result = $anubis->decrypt($text);
                    $result2 = $anubis->encrypt($result);
                }
            } else {
                $result = '�� ������� �������� (����������� ��� ������������?)';
            }
    } else {
        $result = '����� �� ������';
    }
}
?>


<form method="post">
    ����:<br>
    <input type="text" name="key" style="width: 250px;" value="<? print $key; ?>"><br><br>
    <input type="radio" name="operation" value="encode" <? if ($operation=='encode'){ print 'checked';} ?> >�����������
    <input type="radio" name="operation" value="decode" <? if ($operation=='decode'){ print 'checked';} ?>>������������ <br>
    �������� �����:<br>
    <textarea name="text" style="height: 100px; width: 200px"><? print $text; ?></textarea><br><br>
    <input type="submit"><br><br><br>
    ���������:<br>
    <textarea name="result" style="height: 100px; width: 200px"><? print $result; ?></textarea><br><br>
    �������� �������� �� ���������:<br>
    <textarea name="result2" style="height: 100px; width: 200px"><? print $result2; ?></textarea>
</form>
