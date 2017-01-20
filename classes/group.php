<?php
/**
 * Created by PhpStorm.
 * User: Максим
 * Date: 23.03.14
 * Time: 0:53
 */

class group
{

    public $id, $name, $institut, $users = array(), $praepostor, $curator, $speciality;
    private $db;
    const TEACHER_GROUP_ID = -1, ADMINISTRATION_GROUP_ID = -2;

    function group($idGroup, $fullUsers = false)
    {
        $this->db = new db();
        $this->id = $idGroup;
        $this->fillGroup();
        $this->fillUsersGroup($fullUsers);
    }

    function getInstitut()
    {
        return new institut($this->institut);
    }

    function fillGroup()
    {
        $query = "SELECT * FROM `group` WHERE `id`=" . $this->id . ";";
        $res = $this->db->arrayResult($query);
        $this->name = $res['name'];
        $this->institut = $res['institut'];
        $this->curator = $res['curator'];
        $this->praepostor = $res['praepostor'];
        $this->speciality = $res['speciality'];
    }

    function getCurator(){
        return new user($this->curator);
    }

    function getNameSpeciality(){
        $query = "SELECT `name` FROM `studinfo`.`specialties` WHERE `number` = $this->speciality";
        return $this->db->singleResult($query);
    }

    function getPraepostor(){
        return new user($this->praepostor);
    }

    function fillUsersGroup($fullUsers)
    {
        $query = "SELECT `id` FROM `student` WHERE `group`=" . $this->id . ";";
        $res = $this->db->dArrayResult($query);
        if ($fullUsers) {
            foreach ($res as $row) {
                $this->users[] = new user($row['id']);
            }
        } else {
            foreach ($res as $row) {
                $this->users[] = $row['id'];
            }
        }
    }

    function getUsers(){
        if (is_object($this->users)) { return null;}
        $resUsers = array();
        foreach ($this->users as $user) {
            $u = new user($user);
            if ($u->confirmed)
                $resUsers[] = $u;
        }
        return $resUsers;
    }

    function getDiscipline()
    {
        $query = "SELECT `id` FROM `discipline` WHERE `group`=".$this->id.";";
        $res = $this->db->dArrayResult($query);
        $discipline = array();
        foreach ($res as $row)
        {
            $discipline[] = new discipline($row['id']);
        }
        return $discipline;
    }


}