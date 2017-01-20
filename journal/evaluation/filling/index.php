<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 27.05.14
 * Time: 21:53
 */
include_once('../../../classes/autoload.php');
print '<div id="header">';
include($root . '/profile/header.php');

print '</div><div id="wrapper">';
include($root . '/profile/leftblock.php');

print '
         <div id="rightContent">
        <h3>' . $my->getFullName() . '</h3>
	    <h4>Группа ' . $my->getGroup() . '</h4>
	     </div>
		  ';

include('../groupsTabs.php');
//include('../modeTabs.php');
$_GET['m']= 'schedule';
print '
         <div id="rightContent">
         <table style="width: 100%;">
            <tr>
                <td id="previous" style="text-align: center; width: 33%;"></td>
                <td id="now" style="text-align: center; background-color: rgb(204, 230, 150); width: 33%;"></td>
                <td id="next" style="text-align: center; width: 33%;"></td>
            </tr>
         </table>
	     </div>
		  ';
print '<div id="rightContent">';
switch ($_GET['m']) {
    case "schedule": ////Содержмиое по студентам
        $group = new group($_GET['g']);
        $users = $group->getUsers();
        if ($my->student){
            $journal = new journal($group->id);
        } else {
            $journal = new teacherJournal($my->id);
        }
        if (count($users) == 0) {
            print 'В группе нет студентов!';
            break;
        }
        print '<form method="post" action="receivingEvaluation.php">
        <table class="tables">';
        foreach ($users as $user) {
            $evaluation = $journal->getUserEvaluationOnSchedule($user->id);
            print ' <tr>
                        <td width="20%">' . $user->getFullName(false) . '</td>
                        <td width="80%"><input class="evaluations" value="'.$evaluation.'" id="input3" name=' . $user->id . ' type="text" autocomplete="off"/></td>
                    </tr>';
        }
        print '</table>
        <input type="submit" value="Отправить"/>
        </form>';
        break;
    case "discipline":
        print 'Временно недоступно!';
        break;
}
//////////////
?>
</div></div>
<div class="clear">
    <div id="footer">
        &copy; 2013 - 2014 artvaZ studio | <a href="#">студинфо.ру</a> <br>
    </div>
</div></div>
<?
if ($my->student) {
    print "<script src='lessons.php?g=$my->group'></script>";
} else {
    print "<script src='lessons.php?u=$my->id'></script>";
}
?>
<script>
    $('.evaluations').keydown(function (e) {
        if ((e.keyCode < 49 || e.keyCode > 53) && e.keyCode != 89 && e.keyCode != 8 &&
            e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 32){
            return false;
        }
        console.log(e);
        if ((doGetCaretPosition(this) >= lessons.length) && e.keyCode != 8 &&
            e.keyCode != 37){
            return false;
        }
    });

    $('.evaluations').keyup(function () {
        refreshLessons(this);
    });

    $('.evaluations').click(function (e) {
        refreshLessons(this);
    });

    function refreshLessons(el){
        var num = doGetCaretPosition(el);
        if (num == lessons.length){
            num--;
        }
        if (num == 0) {
            $('#previous').html('-');
        } else {
            $('#previous').html(lessons[num - 1].discipline + '<br>' +
                lessons[num - 1].teacher + '<br>' + lessons[num - 1].group + '<br>' +
                lessons[num - 1].date + '<br>' + lessons[num - 1].time);
        }
        $('#now').html(lessons[num ].discipline + '<br>' +
            lessons[num].teacher + '<br>' + lessons[num].group + '<br>' +
            lessons[num].date + '<br>' + lessons[num].time);
        if (lessons.length != num + 1) {
            $('#next').html(lessons[num + 1].discipline + '<br>' +
                lessons[num + 1].teacher + '<br>' + lessons[num + 1].group + '<br>' +
                lessons[num + 1].date + '<br>' + lessons[num + 1].time);
        } else {
            $('#next').html('-');
            return false;
        }
        return true;
    }

    function doGetCaretPosition (ctrl) {
        var CaretPos = 0;
        if (document.selection) {
            ctrl.focus ();
            var Sel = document.selection.createRange ();
            Sel.moveStart ('character', -ctrl.value.length);
            CaretPos = Sel.text.length;
        } else if (ctrl.selectionStart || ctrl.selectionStart == '0')
            CaretPos = ctrl.selectionStart;
        return (CaretPos);
    }

</script>