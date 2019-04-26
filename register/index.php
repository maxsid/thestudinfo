<link rel="stylesheet" type="text/css" href="../styles/css/autocomplete.css"/>
<link rel="stylesheet" type="text/css" href="../styles/css/register.css"/>
    <div class="register" onclick="return buttonClick();">
        <fieldset class="row1">
            <legend>Детали аккаунта
            </legend>
            <p>
                <label>Email
                </label>
                <input id="userEmail" type="text" autocomplete="off"/>
                <label>Повторите email
                </label>
                <input type="text"/>
            </p>
        </fieldset>
        <fieldset class="row2">
            <legend>Персональные детали
            </legend>
            <p>
                <label>Вы:</label>
                <input type="radio" id="userStudent" name="typeUser" value="radio"/>
                <label class="gender">Студент</label>
                <input type="radio" id="userTeacher" name="typeUser" value="radio"/>
                <label class="gender">Преподаватель</label>
            </p>

            <p>
                <label>Фамилия
                </label>
                <input id="userLastName" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>Имя
                </label>
                <input id="userName" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>Отчество
                </label>
                <input id="userPatronymic" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>Другие данные
                </label>
                <textarea id="userOtherData" class="biglong" type="text" style="resize: none;"></textarea>
            </p>

        </fieldset>
        <fieldset class="row3">
            <legend>Информация учебного заведения
            </legend>
            <p>
                <label>Наименование:
                </label>
                <input id="institut" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>Группа:
                </label>
                <input id="group" type="text" class="long" autocomplete="off" disabled/>
            </p>

            <div class="infobox"><h4>Полезная информация</h4>

                <p>После регистрации и проверки пользователя учебным заведением, вы получаете логин и пароль. Относитесь
                    внимательнее к введенным вами данным. .</p>
            </div>
        </fieldset>
        <fieldset class="row4">
            <legend>Пользовательское соглашение
            </legend>
            <p class="agreement">
                <input type="checkbox" value=""/>
                <label>Я прочитал <a href="#">соглашение сайта</a></label>
            </p>
        </fieldset>
        <div>
            <button class="button button-primary" onclick="return false">Регистрация</button>
        </div>
    </div>
<script>
    /**
     * Created by Максим Сидоров on 07.06.14.
     */
    var inst = '',
        group = '';
    $('input[type=radio]').click(function () {
        lockGroup();
    });

    function lockGroup() {
        if (userStudent.checked && inst != '') {
            document.getElementById('group').disabled = 0;
        } else {
            document.getElementById('group').disabled = 1;
        }
    };

    function buttonClick() {
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

        $('.register').html('Загрузка...');
        $('.register').load('/register/send.php' +
            '?i=' + inst +
            '&t=' + stud +
            '&g=' + group +
            '&n=' + encodeURI(name) +
            '&l=' + encodeURI(lastname) +
            '&p=' + encodeURI(patronymic) +
            '&e=' + encodeURI(email) +
            '&d=' + encodeURI(otherData)
        );
        return false;
    }
    ;

    $('#institut').autocomplete({
        serviceUrl: '/register/institutions.php',
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function (element) {
            inst = element.id;
            $('#group').autocomplete('setOptions', {params: {"i": inst}});
            lockGroup();
        },
        onInvalidateSelection: function () {
            inst = '';
            lockGroup();
        }
    });
    $('#group').autocomplete({
        serviceUrl: '/register/groups.php',
        minChars: 0,
        autoSelectFirst: true,
        onSelect: function (element) {
            group = element.id;
        },
        onInvalidateSelection: function () {
            group = '';
        }
    });
</script>