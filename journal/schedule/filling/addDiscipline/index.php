<?php
/**1
 * Created by PhpStorm.
 * User: ������ �������
 * Date: 21.05.14
 * Time: 19:03
 */
include_once('../../../../classes/autoload.php');
print '<div id="addDiscipline">';
print '<h3>���������� ����������</h3>';
print '<span id="error" style="color: #ff0000;"></span>';
print '��������:<input type="text" id="input2" name="disciplineName"/><br>
       ������:<input id="input2" type="text" class="group" name="disciplineGroup"/><br>
            <input type="hidden" name="disciplineGroupId"/>
       �������������:<input id="input2" type="text" class="teacher" name="disciplineTeacher"/><br>
            <input type="hidden" name="disciplineTeacherId">
       ���������:<input id="input2" type="text" name="disciplineAudience"/><br>
            <input type="submit" value="��������" onclick="checkFill();"/>
        </div>';
?>
<script type="text/javascript" src="/styles/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="/journal/schedule/filling/data.php?i=<? echo $my->institut; ?>"></script>
<script>
    function checkFill() {
        var discipline = document.getElementsByName('disciplineName')[0].value;
        var group = document.getElementsByName('disciplineGroupId')[0].value;
        var teacher = document.getElementsByName('disciplineTeacherId')[0].value;
        var audience = document.getElementsByName('disciplineAudience')[0].value;
        switch ("")
        {
            case discipline:
                errorMessage('�� ������� ��������!');
                return false;
            case document.getElementsByName('disciplineGroup')[0].value:
                errorMessage('�� ������� ������!');
                return false;
            case document.getElementsByName('disciplineTeacher')[0].value:
                errorMessage('�� ������ �������������!');
                return false;
            case audience:
                errorMessage('�� ������ ����� ���������!');
                return false;
            case group:
                errorMessage('������ ���������� ������� �� ������!');
                return false;
            case teacher:
                errorMessage('������������� ���������� ������� �� ������!');
                return false;
        }
        $('#addDiscipline').text('Loading...');
        $('#addDiscipline').load('source.php?dn='+discipline+'&dg='+group+'&dt='+teacher+'&da='+audience);
        return false;
    }

    function errorMessage(message) {
        errorMessage = document.getElementById('error').innerHTML = message;
    }

    $('.group').autocomplete({
        lookup: groups,
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function(element){
            document.getElementsByName('disciplineGroupId')[0].value = element.id;
        }
    });
    $('.teacher').autocomplete({
        lookup: teachers,
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function(element){
            document.getElementsByName('disciplineTeacherId')[0].value = element.id;
        }
    });
</script>
<style>
    .container { width: 800px; margin: 0 auto; }
    .autocomplete-suggestions { border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
</style>
