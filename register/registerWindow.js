/**
 * Created by ������ ������� on 07.06.14.
 */
var inst = '',
    group = '';
$('input[type=radio]').click(function(){
    lockGroup();
});

function lockGroup() {
    if (userStudent.checked && inst != ''){
        document.getElementById('group').disabled = 0;
    } else {
        document.getElementById('group').disabled = 1;
    }
};

$('#next').click(function(){
    if (!userTeacher.checked && !userStudent.checked) {
        $('#message').html('�� ������� ��� �������������? <br> ���������� �������.');
        return;
    }
    var stud = String(userStudent.checked);
    var name = userName.value;
    var lastname = userLastName.value;
    var patronymic = userPatronymic.value;
    var email = userEmail.value;
    var otherData = userOtherData.value;

    switch ('') {
        case inst:
            $('#message').html('�� ������� ������� ����������.<br>(���������� ������� �� ����������� ������)');
            return;
        case name:
            $('#message').html('��� �� �������.');
            return;
        case lastname:
            $('#message').html('������� �� �������.');
            return;
        case patronymic:
            $('#message').html('�������� �� �������.');
            return;
        case email:
            $('#message').html('Email �� ������.');
            return;
        case group:
            if (userStudent.checked) {
                $('#message').html('�� ������� ������.<br>(���������� ������� �� ����������� ������)');
                return;
            }
    }

    $('#regPage').html('��������...');
    $('#regPage').load('/register/send.php' +
        '?i=' + inst +
        '&t=' + stud +
        '&g=' + group +
        '&n=' + encodeURI(name) +
        '&l=' + encodeURI(lastname) +
        '&p=' + encodeURI(patronymic) +
        '&e=' + encodeURI(email) +
        '&d=' + encodeURI(otherData)
    );
});

$('#institut').autocomplete({
    serviceUrl: '/register/institutions.php',
    minChars: 0,
    autoSelectFirst: true,
    onSelect: function(element){
        inst = element.id;
        $('#group').autocomplete('setOptions', {params: {"i":inst}});
        lockGroup();
    },
    onInvalidateSelection: function(){
        inst = '';
        lockGroup();
    }
});
$('#group').autocomplete({
    serviceUrl: '/register/groups.php',
    minChars: 0,
    autoSelectFirst: true,
    onSelect: function(element){
        group = element.id;
    },
    onInvalidateSelection: function(){
        group = '';
    }
});