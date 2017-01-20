<?php
/**
 * Created by PhpStorm.
 * User: ??????
 * Date: 12.04.14
 * Time: 6:03
 */

class institut {
    public $id, $name, $fullName, $prefix;
    private $db;

    function institut($id)
    {
        $this->db = new db();
        $this->id = $id;
        $this->fillInstitut();
    }

    function getAdministration()
    {
        $query = "SELECT `users`.`id` FROM `administration` LEFT OUTER JOIN `users`
        ON `administration`.`id` = `users`.`id`
        WHERE `institut` = " . $this->id . ";";
        $res = $this->db->dArrayResult($query);
        foreach ($res as $row) {
            $user = new user($row['id']);
            if ($user->confirmed)
                $arr[] = $user;
        }
        return $arr;
    }

    function getAdministrationDontTeacher()
    {
        $arr = array();
        $query = "SELECT `users`.`id` FROM `administration` LEFT OUTER JOIN `users`
        ON `administration`.`id` = `users`.`id`
        WHERE `institut` = " . $this->id . " AND `administration`.`teacher`=0;";
        $res = $this->db->dArrayResult($query);
        foreach ($res as $row) {
            $user = new user($row['id']);
            if ($user->confirmed)
                $arr[] = $user;
        }
        return $arr;
    }

    function getCountAdministration()
    {
        $query = "  SELECT COUNT(`users`.`id`)
                    FROM `users` LEFT OUTER JOIN `administration`
                    ON `administration`.`id` = `users`.`id`
                    WHERE `users`.`institut`=" . $this->id . ";";
        return $this->db->singleResult($query);
    }

    function getTeacher()
    {
        $arr = array();
        $query = "SELECT `users`.`id` FROM `administration` LEFT OUTER JOIN `users`
        ON `administration`.`id` = `users`.`id`
        WHERE `institut` = " . $this->id . " AND `administration`.`teacher`=1;";
        $res = $this->db->dArrayResult($query);
        foreach ($res as $row) {
            $user = new user($row['id']);
            if ($user->confirmed)
                $arr[] = $user;
        }
        return $arr;
    }


    function fillInstitut()
    {
        //Old version
        /*$query = 'SELECT * FROM `group` WHERE `institut`='.$this->id.';';
        $this->groups = $this->db->dArrayResult($query);*/
        $query = "SELECT * FROM `institutions` WHERE `id`=" . $this->id . ";";
        $res = $this->db->arrayResult($query);
        $this->name = $res['name'];
        $this->fullName = $res['fullname'];
        $this->prefix = $res['prefix'];
    }

    function getGroupsInstitut($fullGroups, $fullUsers)
    {
        $query = "SELECT `id` FROM `group` WHERE `institut`=" . $this->id . ";";
        $res = $this->db->dArrayResult($query);
        $groups = array();
        if ($fullGroups) {
            foreach ($res as $row) {
                $groups[] = new group($row['id'], $fullUsers);
            }
        } else {
            foreach ($res as $row) {
                $groups[] = $row['id'];
            }
        }
        return $groups;
    }
} 