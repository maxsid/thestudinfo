<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 13.05.14
 * Time: 0:28
 */

class lesson
{

    public $id, $discipline, $teacher, $audience, $date, $time, $comment, $group;
    private $db;

    function lesson($id){
        $this->id = $id;
        $this->db = new db();
        $this->fill();
    }

    private function fill(){
        $query = "SELECT * FROM `schedule` WHERE `id`=" . $this->id . ";";
        $res = $this->db->arrayResult($query);
        $this->discipline = $res['discipline'];
        $this->teacher = $res['teacher'];
        $this->audience = $res['audience'];
        $this->dateParse($res['datetime']);
        $this->comment = $res['comment'];
        $this->group = $res['group'];
    }

    function getTeacher(){
        return new user($this->teacher);
    }

    function getGroup(){
        return new group($this->group);
    }

    function getDiscipline(){
        return new discipline($this->discipline);
    }

    private function dateParse($datetime){
        $datetime = date_parse($datetime);
        $date = mktime(0, 0, 0, $datetime["month"], $datetime["day"], $datetime["year"]);
        $time = mktime($datetime["hour"], $datetime["minute"]);

        $this->date = date("d.m.Y", $date);
        $this->time = date("H:i", $time);
    }

    function addEvaluation($studentId,$evaluation){
        $query = "SELECT * FROM `studinfo`.`evaluation` WHERE `lesson` = $this->id AND `student` = $studentId";
        if ($this->db->countRow($query) == 0){
            $query = "INSERT INTO `studinfo`.`evaluation` (`lesson`,`student`,`evaluation`) VALUES
        ($this->id, $studentId,'$evaluation')";
        } else {
            $query = "  UPDATE `studinfo`.`evaluation` SET `evaluation` = $evaluation
                        WHERE `lesson` = $this->id AND `student` = $studentId";
        }
        $this->db->query($query);
    }

    function getUsersAndEvaluation(){
        $query = "SELECT * FROM `studinfo`.`evaluation` WHERE `lesson` = $this->id";
        $res = $this->db->dArrayResult($query);
        $arr = array();
        foreach ($res as $key=>$row){
            $arr[$key][0] = new user($row['student']);
            $arr[$key][1] = $row['evaluation'];
        }
        return $arr;
    }

    function getEvaluationUser($userId){
        $query = "SELECT `evaluation` FROM `studinfo`.`evaluation` WHERE `lesson` = $this->id AND `student` = $userId";
        if ($this->db->countRow($query) == 0){
            return '-';
        }
        return $this->db->singleResult($query);
    }

    function getAverageEvaluation(){
        $query = "SELECT `evaluation` FROM `studinfo`.`evaluation` WHERE `lesson` = $this->id";
        if ($this->db->countRow($query) == 0){
            return '-';
        }
        $query = "SELECT avg(`evaluation`) FROM `studinfo`.`evaluation` WHERE `lesson` = $this->id";
        return $this->db->singleResult($query);
    }

    function getCountOmissions(){
        $query = "SELECT `id` FROM `studinfo`.`evaluation` WHERE `evaluation` = 'Н' AND `lesson` = $this->id";
        return $this->db->countRow($query);
    }
} 