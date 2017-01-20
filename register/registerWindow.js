/**
 * Created by Максим Сидоров on 07.06.14.
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
        $('#message').html('Вы студент или преподаватель? <br> Необходимо выбрать.');
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
            $('#message').html('Не выбрано учебное учреждение.<br>(Необходимо выбрать из выпадающего списка)');
            return;
        case name:
            $('#message').html('Имя не введено.');
            return;
        case lastname:
            $('#message').html('Фамилия не введена.');
            return;
        case patronymic:
            $('#message').html('Отчество не введено.');
            return;
        case email:
            $('#message').html('Email не введен.');
            return;
        case group:
            if (userStudent.checked) {
                $('#message').html('Не выбрана группа.<br>(Необходимо выбрать из выпадающего списка)');
                return;
            }
    }

    $('#regPage').html('Загрузка...');
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