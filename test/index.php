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
                $result = 'Не выбрана операция (зашифровать или расшифровать?)';
            }
    } else {
        $result = 'Текст не введен';
    }
}
?>


<form method="post">
    Ключ:<br>
    <input type="text" name="key" style="width: 250px;" value="<? print $key; ?>"><br><br>
    <input type="radio" name="operation" value="encode" <? if ($operation=='encode'){ print 'checked';} ?> >Зашифровать
    <input type="radio" name="operation" value="decode" <? if ($operation=='decode'){ print 'checked';} ?>>Расшифровать <br>
    Исходный текст:<br>
    <textarea name="text" style="height: 100px; width: 200px"><? print $text; ?></textarea><br><br>
    <input type="submit"><br><br><br>
    Результат:<br>
    <textarea name="result" style="height: 100px; width: 200px"><? print $result; ?></textarea><br><br>
    Обратное действие на результат:<br>
    <textarea name="result2" style="height: 100px; width: 200px"><? print $result2; ?></textarea>
</form>
