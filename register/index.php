<link rel="stylesheet" type="text/css" href="../styles/css/autocomplete.css"/>
<link rel="stylesheet" type="text/css" href="../styles/css/register.css"/>
    <div class="register" onclick="return buttonClick();">
        <fieldset class="row1">
            <legend>������ ��������
            </legend>
            <p>
                <label>Email
                </label>
                <input id="userEmail" type="text" autocomplete="off"/>
                <label>��������� email
                </label>
                <input type="text"/>
            </p>
        </fieldset>
        <fieldset class="row2">
            <legend>������������ ������
            </legend>
            <p>
                <label>��:</label>
                <input type="radio" id="userStudent" name="typeUser" value="radio"/>
                <label class="gender">�������</label>
                <input type="radio" id="userTeacher" name="typeUser" value="radio"/>
                <label class="gender">�������������</label>
            </p>

            <p>
                <label>�������
                </label>
                <input id="userLastName" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>���
                </label>
                <input id="userName" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>��������
                </label>
                <input id="userPatronymic" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>������ ������
                </label>
                <textarea id="userOtherData" class="biglong" type="text" style="resize: none;"></textarea>
            </p>

        </fieldset>
        <fieldset class="row3">
            <legend>���������� �������� ���������
            </legend>
            <p>
                <label>������������:
                </label>
                <input id="institut" type="text" class="long" autocomplete="off"/>
            </p>

            <p>
                <label>������:
                </label>
                <input id="group" type="text" class="long" autocomplete="off" disabled/>
            </p>

            <div class="infobox"><h4>�������� ����������</h4>

                <p>����� ����������� � �������� ������������ ������� ����������, �� ��������� ����� � ������. ����������
                    ������������ � ��������� ���� ������. .</p>
            </div>
        </fieldset>
        <fieldset class="row4">
            <legend>���������������� ����������
            </legend>
            <p class="agreement">
                <input type="checkbox" value=""/>
                <label>� �������� <a href="#">���������� �����</a></label>
            </p>
        </fieldset>
        <div>
            <button class="button button-primary" onclick="return false">�����������</button>
        </div>
    </div>
<script>
    /**
     * Created by ������ ������� on 07.06.14.
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

        $('.register').html('��������...');
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