<?php
class discipline {
    public $id, $name, $group, $teacher, $audience;
    private $db;

    function __construct($id)
    {
        $this->id = $id;
        $this->db = new db();
        $query = "SELECT * FROM `discipline` WHERE `id` = ".$id.";";
        $res = $this->db->arrayResult($query);
        $this->name = $res['name'];
        $this->group = $res['group'];
        $this->teacher = $res['teacher'];
        $this->audience = $res['audience'];
    }

    function getTeacher()
    {
        $teacher = new user($this->teacher);
        return $teacher;
    }

    static function registerDiscipline($name,$group,$teacher,$audience)
    {
        if (is_null($name) | is_null($group) | is_null($teacher) | is_null($audience)){
            return false;
        }
        $db = new db();
        $db->query("INSERT INTO `studinfo`.`discipline` (`name`,`group`,`teacher`,`audience`)
                    VALUES ('$name',$group,$teacher,'$audience');");
        return true;
    }

} 