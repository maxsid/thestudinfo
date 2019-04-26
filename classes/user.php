<?php
class user
{

    public $id, $name, $lastname, $patronymic, $avatar, $numberstud, $group, $institut, $email;
    public $student, $teacher, $confirmed;
    private $db;
    public $mail;

    function user($userId = 0)
    {
        $this->db = new db();
        if ($userId != 0) {
            $this->otherUser($userId);
        }
    }

    public function mainUser($login, $password)
    {

        $query = " SELECT `id` FROM `users`
                   WHERE `login`='$login'
                   AND `password`='$password';";
        $res = $this->db->singleResult($query);
        if (empty($res)) {
            unset($_SESSION);
            return false;
        }
        $this->otherUser($res);
        if (!$this->confirmed) {
            unset ($_SESSION);
            return false;
        }
        $this->mail = new someMessages($this->id);
        return true;
    }

    function register($otherData = '')
    {
        if (!$this->checkEmail()) {
            return 'Ваш email уже зарегистрирован!';
        }
        if (!$this->student) {
            if ($this->teacher) {
                $this->group = group::TEACHER_GROUP_ID;
                $strPost = 'Преподаватель';
            } else {
                $this->group = group::ADMINISTRATION_GROUP_ID;
                $strPost = 'Работник администрации';
            }
        } else {
            $strPost = 'Студент';
        }

        $query = ("INSERT INTO `studinfo`.`users`
        (`login`,`password`,`name`,`lastname`,`patronymic`,`institut`,`email`,`student`)
        VALUES
        ('','','$this->name','$this->lastname','$this->patronymic',`$this->institut`,'$this->email','$this->student');");
        $this->db->query($query);
        $query = "SELECT `id` FROM `studinfo`.`users` WHERE `email` = '$this->email'";
        $this->id = $this->db->singleResult($query);
        $query = "INSERT INTO `studinfo`.`registration` (`id`,`comments`)
                    VALUES (`$this->id`,'$otherData');";
        $this->db->query($query);
        if ($this->student) {
            $query = "  INSERT INTO `studinfo`.`student` (`id`,`numberstud`,`group`)
                        VALUES ($this->id,0,$this->group)";
        } else {
            $query = "  INSERT INTO `studinfo`.`administration` (`id`,`teacher`)
                        VALUES (`$this->id`,`$this->teacher`)";
        }
        $this->db->query($query);
        //Рассылка сообщения
        ////Сбор получателей
        $rec = array();
        if ($this->student) {
            $group = $this->getObjectGroup();
            $rec[] = $group->getCurator()->id;
            $rec[] = $group->getPraepostor()->id;
            unset($group);
        } else {
            $inst = $this->getInstitut();
            $admins = $inst->getAdministration();
            foreach ($admins as $a) {
                $rec[] = $a->id;
            }
            unset($inst);
            unset($admins);
        }
        ////Заполнение и отправка сообщения
        $message = new message();
        $message->fillAndSend(0, 'Запрос на регистрацию',
            'Здравствуйте. ' . $strPost . ' ' . $this->getFullName() . ' запрашивает подтверждение регистрации.<br>
            Пользователь указал следующие данные:<br>' .
            'Email: ' . $this->email . '<br>' .
            'Другое:<br>' .
            $otherData . '
            <div id="checkReg' . $this->id . '"></div>
            <script>
                $("#checkReg' . $this->id . '").load("/register/check.php?u=' . $this->id . '");
            </script>'
            , $rec);
        //Отправилось
        return "Уважаемый(ая) $this->name $this->patronymic.<br>
        Ваша регистрация на сайте <a href='http://thestudinfo.ru'>theStudInfo.ru</a> добавлена в базу данных и ждет подтверждения.<br>
        После подтверждения ваш логин и пароль будут отправлены на $this->email. <br>
        Спасибо, что вы с нами!";
    }

    private function generateLoginAndPassword()
    {
        $password = text::generate();
        $encodePassword = text::encoding($password);
        $inst = new institut($this->institut);
        $prefix = $inst->prefix;
        $nameLetters = 'n';
        $patronymicLetters = 'p';
        $login = $prefix . '_' . text::transliterate($this->getName('Lnp'));
        $encodeLogin = text::encoding($login);
        while (!$this->checkLogin($encodeLogin)) {
            if (strlen($patronymicLetters) != strlen($nameLetters)) {
                $patronymicLetters .= 'p';
            } else {
                $nameLetters .= 'n';
            }
            $login = $prefix . '_' . text::transliterate($this->getName('L' . $nameLetters . $patronymicLetters));
            $encodeLogin = text::encoding($login);
        }

        $query = "  UPDATE `studinfo`.`users`
                    SET `login` = '$encodeLogin', `password` = '$encodePassword'
                    WHERE `id` = `$this->id`";
        $this->db->query($query);
        return Array('login' => $login, 'password' => $password);
    }

    private function deleteRegistration()
    {
        $query = "SELECT count(*) FROM `studinfo`.`registration` WHERE `id` = `$this->id`;";
        if ($this->db->singleResult($query) > 0) {
            $query = "DELETE FROM `studinfo`.`registration` WHERE `id` = `$this->id`;";
            $this->db->query($query);
        }
    }

    public function confirmRegistration()
    {
        $query = "SELECT count(*) FROM `studinfo`.`registration` WHERE `id` = `$this->id`;";
        if ($this->db->singleResult($query) > 0) {
            $query = "DELETE FROM `studinfo`.`registration` WHERE `id` = `$this->id`;";
            $this->db->query($query);
            $enterData = $this->generateLoginAndPassword();
            if (isset($this->email)) {
                //Отправка письма
                $mail = new PHPMailer();
                $mail->isHTML();
                $mail->CharSet = 'utf-8';
                $mail->Body = "Здравствуйте " . $this->getFullName() . "<br>
                Ваша учетная запись на <a href='http://thestudinfo.ru'>theStudInfo</a> была подтвержденна." .
                    "Ваши данные для входа:<br>" .
                    "Логин:" . $enterData['login'] . "<br>" .
                    "Пароль:" . $enterData['password'] . "<br>" .
                    "Спасибо, что вы с нами!";
                $mail->SetFrom('admin@thestudinfo.ru', 'Администрация theStudInfo.ru');
                $mail->AddAddress($this->email, $this->getFullName());
                $mail->Subject = "Регистрация на theStudInfo";
                $mail->Send();
                //
            }
        }
    }

    private function fillConfirmedRegistration()
    {
        $query = "SELECT count(*) FROM `studinfo`.`registration` WHERE `id` = $this->id;";
        if ($this->db->singleResult($query) > 0) {
            $this->confirmed = false;
        } else {
            $this->confirmed = true;
        }
    }

    private function checkEmail($email = null)
    {
        if (empty($email)) {
            $email = $this->email;
        }
        $query = "SELECT count(*) FROM `studinfo`.`users` WHERE `email` = '$email';";
        if ($this->db->singleResult($query) > 0) {
            return false;
        }
        return true;
    }

    private function checkLogin($login)
    {
        $query = "SELECT count(*) FROM `studinfo`.`users` WHERE `login` = '$login';";
        if ($this->db->singleResult($query) > 0) {
            return false;
        }
        return true;
    }

    function fillUser($id, $name, $lastname, $patronymic, $numberstud, $group, $institut, $email, $student, $teacher, $confirmed, $avatar)
    {
        $this->id = $id;
        $this->name = $name;
        $this->patronymic = $patronymic;
        $this->lastname = $lastname;
        $this->numberstud = $numberstud;
        $this->group = $group;
        $this->institut = $institut;
        $this->email = $email;
        $this->student = $student;
        $this->teacher = $teacher;
        $this->confirmed = $confirmed;
        $this->avatar = $avatar;
    }

    public function otherUser($id)
    {
        if ($id == 0) {
            $this->fillUser(0, '', 'Администрация ресурса', '', '', 0, 0, 'admins@studinfo.ru', false, false, false, '');
            return true;
        }
        $query = "SELECT * FROM `users` WHERE `id`=" . $id . ";";

        $res = $this->db->arrayResult($query);
        if (count($res) == 0)
            return false;
        $this->fillAdapter($res);
        return true;
    }

    private function fillAdapter($res)
    {
        $this->id = $res['id'];
        $this->name = $res['name'];
        $this->lastname = $res['lastname'];
        $this->institut = $res['institut'];
        $this->patronymic = $res['patronymic'];
        $this->avatar = $res['avatar'];
        $this->email = $res['email'];
        $this->student = (boolean)$res['student'];
        if ($this->student) {
            $query = "SELECT * FROM `student` WHERE `id`=" . $this->id . ";";
            $res = $this->db->arrayResult($query);
            $this->numberstud = $res['numberstud'];
            $this->group = $res['group'];
        } else {
            $query = "SELECT * FROM `administration` WHERE `id`=`$this->id`;";
            $res = $this->db->arrayResult($query);
            $this->teacher = (boolean)$res['teacher'];
            if ($this->teacher) {
                $this->group = group::TEACHER_GROUP_ID;
            } else {
                $this->group = group::ADMINISTRATION_GROUP_ID;
            }
        }
        $this->fillConfirmedRegistration();
    }

    function getName($format)
    {
        $result = '';

        for ($i = 0, $letter = '', $position = 0; $i < strlen($format); $i++) {
            switch ($format[$i]) {
                case 'L':
                    $result .= $this->lastname;
                    break;
                case 'N':
                    $result .= $this->name;
                    break;
                case 'P':
                    $result .= $this->patronymic;
                    break;
                case 'l':
                    if ($letter != 'l') {
                        $position = 0;
                    }
                    if ($position >= strlen($this->lastname)) {
                        break;
                    }
                    $letter = 'l';
                    $result .= substr($this->lastname, $position++, 1);
                    break;
                case 'n':
                    if ($letter != 'n') {
                        $position = 0;
                    }
                    if ($position >= strlen($this->name)) {
                        break;
                    }
                    $letter = 'n';
                    $result .= substr($this->name, $position++, 1);
                    break;
                case 'p':
                    if ($letter != 'p') {
                        $position = 0;
                    }
                    if ($position >= strlen($this->patronymic)) {
                        break;
                    }
                    $letter = 'p';
                    $result .= substr($this->patronymic, $position++, 1);
                    break;
                default:
                    $result .= $format[$i];
                    break;
            }
        }

        return $result;
    }

    public function getFullName($includePatonymic = true, $initials = false, $family = true)
    {
        if ($initials) {
            $name = ' ' . $this->name[0] . ".";
            $patronymic = ' ' . $this->patronymic[0] . '.';
        } else {
            $name = ' ' . $this->name;
            $patronymic = ' ' . $this->patronymic;
        }

        if (!$includePatonymic) {
            $patronymic = "";
        }

        if (!$family) {
            $lastname = "";
        } else {
            $lastname = $this->lastname;
        }

        $fullName = $lastname . $name . $patronymic;
        return $fullName;
    }

    public function getInstitut()
    {
        return new institut($this->institut);
    }

    public function getGroup()
    {
        switch ($this->group) {
            case group::TEACHER_GROUP_ID:
                return 'Преподаватели';
            case group::ADMINISTRATION_GROUP_ID:
                return 'Администрация';
        }
        $groupName = $this->db->singleResult("SELECT `name` FROM `group` WHERE `id`= " . $this->group . ";");
        return $groupName;
    }

    public function getObjectGroup()
    {
        return new group($this->group);
    }

    static function authorization()
    {
        $db = new db();
        $login = $_POST['login'];
        $password = $_POST['password'];

        unset($_POST['login']);
        unset($_POST['password']);


        if (isset($_POST['save'])) {
            setcookie("login", $login, time() + 9999999);
            setcookie("password", $password, time() + 9999999);
        }

        $login = stripslashes($login);
        $login = htmlspecialchars($login);

        $password = stripslashes($password);
        $password = htmlspecialchars($password);

        $login = trim($login);
        $password = trim($password);

        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (empty($ip) || $ip == 'unknown') {
            $ip = getenv("REMOTE_ADDR");
        }


        $login = text::encoding($login);
        $password = text::encoding($password);


        $res = $db->singleResult(" SELECT `id` FROM `studinfo`.`users`
                                        WHERE `login`='$login'
                                        AND `password`='$password';");
        if (empty($res) or !$res) {
            return false;
        }
        $user = new user($res);
        if (!$user->confirmed) {
            return false;
        }
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;

        return true;
    }

    function deleteRegisterUser()
    {
        $query = "DELETE FROM `studinfo`.`users` WHERE `id` = $this->id";
        $this->db->query($query);
        if ($this->student) {
            $query = "DELETE FROM `studinfo`.`student` WHERE `id` = `$this->id`";
        } else {
            $query = "DELETE FROM `studinfo`.`administration` WHERE `id` = $this->id";
        }
        $this->db->query($query);
        $this->deleteRegistration();
        if (isset($this->email)) {
            //Отправка письма
            $mail = new PHPMailer();
            $mail->CharSet = 'utf-8';
            $mail->isHTML();
            $mail->Body = "Здравствуйте " . $this->getFullName() . "<br>
            Регистрация вашей учетной записи на <a href='http://thestudinfo.ru'>theStudInfo</a> была отклонена.<br>";
            if ($this->student) {
                $mail->Body .= "Рекомендуем обратиться к старосте или куратору вашей группы.";
            } else {
                $mail->Body .= "Рекомендуем обратиться к администрации вашего учебного заведения.";
            }
            $mail->SetFrom('admin@thestudinfo.ru', 'Администрация theStudInfo.ru');
            $mail->AddAddress($this->email, $this->getFullName());
            $mail->Subject = "Регистрация на theStudInfo";
            $mail->Send();
        }
    }

    static function checkUserId($id)
    {
        $db = new db();
        $query = "SELECT count(`id`) FROM `studinfo`.`users` WHERE `id` = $id";
        $res = $db->singleResult($query);
        if ($res > 0 && $res < 2) {
            return true;
        }
        return false;
    }

    static function getIdAcitveUser()
    {
        if (!isset($_SESSION['login']) && !isset($_SESSION['password'])) {
            return null;
        }
        $db = new db();
        $query = "  SELECT count(`id`) FROM `studinfo`.`users`
                    WHERE `login` = '" . $_SESSION['login'] . "' AND `password` = '" . $_SESSION['password'] . "';";
        if ($db->singleResult($query) == 0) {
            return null;
        }
        $query = "  SELECT `id` FROM `studinfo`.`users`
                    WHERE `login` = '" . $_SESSION['login'] . "' AND `password` = '" . $_SESSION['password'] . "';";
        return $db->singleResult($query);
    }
}

