<?php
spl_autoload_register(function ($class_name) {
    switch ($class_name) {
        case "PHPMailer":
            $class_path = "/elements/mailer/class.phpmailer.php";
            break;
        case "news":
            $class_path = "/news/classes/news.php";
            break;
        case "anyNews":
            $class_path = "/news/classes/anyNews.php";
            break;
        case "someMessages":
            $class_path = '/profile/message/classes/someMessages.php';
            break;
        case "message":
            $class_path = "/profile/message/classes/message.php";
            break;
        case "journal":
            $class_path = "/journal/classes/journal.php";
            break;
        case "teacherJournal":
            $class_path = "/journal/classes/teacherJournal.php";
            break;
        case "lesson":
            $class_path = "/journal/classes/lesson.php";
            break;
        default:
            $class_path = "/classes/" . $class_name . ".php";
            break;
    }
    require_once($_SERVER['DOCUMENT_ROOT'] . $class_path);
});