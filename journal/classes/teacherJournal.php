<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 16.06.14
 * Time: 16:26
 */

class teacherJournal {

    public $teacherId;
    private $db;

    function teacherJournal($teacheId){
        $this->teacherId = $teacheId;
        $this->db = new db();
    }

    function getTeacher(){
        return new user($this->teacherId);
    }

    function getFollowingLessons($count = 7, $desc = false){
        $now = date('Y-m-d H:i:s');
        $query = "SELECT count(`id`) FROM `studinfo`.`schedule`
                WHERE `teacher` = $this->teacherId AND `datetime` > '$now'";
        if ($desc){
            $query .= " ORDER BY `datetime` DESC";
        } else {
            $query .= "ORDER BY `datetime` ASC";
        }

        $countLessons = $this->db->singleResult($query);
        if ($countLessons == 0){
            return null;
        }
        if ($count == 0){
            $count = $countLessons;
        }
        $query = "SELECT `id` FROM `studinfo`.`schedule`
        WHERE `teacher` = $this->teacherId AND `datetime` > '$now'";
        if ($desc){
            $query .= " ORDER BY `datetime` DESC";
        } else {
            $query .= "ORDER BY `datetime` ASC";
        }
        $res = $this->db->dArrayResult($query);
        $lessonArray = array();
        for ($i = 0; $i < $count;$i++){
            if ($i + 1 > count($res)){
                $lessonArray[] = null;
            } else {
                $lessonArray[] = new lesson($res[$i][0]);
            }
        }
        return $lessonArray;
    }

    function getPreviousLessons($count = 7, $desc = true){
        $now = date('Y-m-d H:i:s');

        $query = "  SELECT count(`id`) FROM `studinfo`.`schedule`
                    WHERE `teacher` = $this->teacherId AND `datetime` < '$now'";
        if ($desc){
            $query .= " ORDER BY `datetime` DESC";
        } else {
            $query .= "ORDER BY `datetime` ASC";
        }
        $countLessons = $this->db->singleResult($query);
        if ($countLessons == 0){
            return null;
        }
        if ($count == 0){
            $count = $countLessons;
        }
        $query = "  SELECT `id` FROM `studinfo`.`schedule`
                    WHERE `teacher` = $this->teacherId AND `datetime` < '$now'";
        if ($desc){
            $query .= " ORDER BY `datetime` DESC";
        } else {
            $query .= "ORDER BY `datetime` ASC";
        }
        $res = $this->db->dArrayResult($query);
        $lessonArray = array();
        for ($i = 0; $i < $count;$i++){
            if ($i + 1 > count($res)){
                $lessonArray[] = null;
            } else {
                $lessonArray[] = new lesson($res[$i][0]);
            }
        }
        return $lessonArray;
    }

    function getUserEvaluationOnSchedule($studentId, $desc = false){
        $query = "  SELECT `evaluation` FROM `studinfo`.`evaluation` RIGHT OUTER JOIN `studinfo`.`schedule`
                    ON `schedule`.`id` = `evaluation`.`lesson`
                    WHERE `student` = $studentId AND `schedule`.`teacher` = $this->teacherId";
        if ($desc){
            $query .= " ORDER BY `datetime` DESC";
        } else {
            $query .= " ORDER BY `datetime` ASC";
        }
        if ($this->db->countRow($query) == 0){
            return null;
        }
        $res = $this->db->dArrayResult($query);
        $evaluation = '';
        foreach ($res as $row){
            $evaluation .= $row[0];
        }
        return $evaluation;
    }
} 