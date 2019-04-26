<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 12.05.14
 * Time: 18:46
 */

class journal {

    public $group;
    private $db;

    function journal($group){
        $this->group = $group;
        $this->db = new db();
    }

    function addLesson($datetime,$discipline,$teacher,$audience, $comment){
            $query = "  INSERT INTO `schedule` (`datetime`,`discipline`,`teacher`,`audience`,`comment`,`group`)
                        VALUES ('$datetime',$discipline,$teacher,'$audience','$comment',$this->group);";
            $this->db->query($query);
            return true;
    }

    function getWeekendsOnWeek($num_week, $year){
        $weekends = array();
        for ($i = 0;$i < 7; $i++) {
            $date = text::getDayWeekForDB($num_week,$year,$i);
            $query = "
                  SELECT *
                  FROM `schedule`
                  WHERE DATE(`datetime`) = '$date' AND `group`=$this->group;";
            if (!$this->db->arrayResult($query)){
                $weekends[] = text::parseDate($date,'d.m.Y');
            }
        }
        return $weekends;
    }

    function getLessonsForDate($date){
        $group = $this->group;
        $date = text::parseDate($date);
        $query = "SELECT `id` FROM `schedule` WHERE `group`='$group' AND DATE(`datetime`) = DATE('$date') ORDER BY TIME(`datetime`);";
        $res = $this->db->dArrayResult($query);
        $les = array();
        foreach($res as $row)
        {
            $les[] = new lesson($row['id']);
        }

        return $les;
    }

    function getLessonsForWeek($num_week,$year){
        $startDay = text::getDayWeekForDB($num_week,$year,0);
        $endDay = text::getDayWeekForDB($num_week,$year,6);
        $checkFill = $this->db->arrayResult("
        SELECT *
        FROM `schedule`
        WHERE DATE(`datetime`) >= '$startDay' AND DATE(`datetime`) <= '$endDay' AND `group`=$this->group;
        "); $checkFill = $checkFill[0];
        if (is_null($checkFill)) { return null;}
        $lessons = array();
        $maxInDay = 0;
        for ($i = 0; $i < 7; $i++)
        {
            $lessons[$i] = $this->getLessonsForDate(text::getDayWeekForDB($num_week,$year,$i));
            if (count($lessons[$i])>$maxInDay) { $maxInDay = count($lessons[$i]);}
        }

        $lessons['weekend'] = $this->getWeekendsOnWeek($num_week,$year);
        $lessons['maxInDay'] = $maxInDay;
        return $lessons;
    }

    function getLessonsForWeekGroupByTimeAndDate($num_week, $year) {
        $lessons = array();
        $times = array();
        $startDay = text::getDayWeekForDB($num_week,$year,0);
        $endDay = text::getDayWeekForDB($num_week,$year,6);
        $maxTime = $this->db->arrayResult("
        SELECT EXTRACT(HOUR FROM MAX(TIME(`datetime`)))
        FROM `schedule`
        WHERE DATE(`datetime`) >= '$startDay' AND DATE(`datetime`) <= '$endDay' AND `group`=$this->group;
        "); $maxTime = $maxTime[0];
        $minTime = $this->db->arrayResult("
        SELECT EXTRACT(HOUR FROM MIN(TIME(`datetime`)))
        FROM `schedule`
        WHERE DATE(`datetime`) >= '$startDay' AND DATE(`datetime`) <= '$endDay' AND `group`=$this->group;
        "); $minTime = $minTime[0];
        if (is_null($minTime) || is_null($maxTime)) {
            return null;
        }
        for ($i = $minTime; $i <= $maxTime;$i++) {
            $times[] = $i;
            for ($j = 0;$j<7;$j++) {
                $date = text::getDayWeekForDB($num_week,$year,$j);
                $query = "
                SELECT `id`
                FROM `schedule`
                WHERE DATE(`datetime`) = '$date' AND EXTRACT(HOUR FROM(`datetime`)) = $i AND `group`=$this->group;
                ";
                try {
                    $res = $this->db->dArrayResult($query);
                } catch(Exception $ex) {
                    $lessons[$i-$minTime][] = null;
                }
                $arr = array();
                foreach ($res as $row) {
                    $arr[] = new lesson($row['id']);
                }
                $lessons[$i-$minTime][] = $arr;
            }
        }
        $lessons['hour'] = $times;
        $lessons['weekend'] = $this->getWeekendsOnWeek($num_week,$year);
        return $lessons;
    }

    function getLessonsForWeekGroupByTime($num_week, $year) {
        $lessons = array();
        $times = array();
        $weekends = array();
        for ($i = 0;$i < 7; $i++) {
            $date = text::getDayWeekForDB($num_week,$year,$i);
            $query = "
                  SELECT *
                  FROM `schedule`
                  WHERE DATE(`datetime`) = '$date' AND `group`=$this->group;";
            if (!$this->db->arrayResult($query)){
                $weekends[] = text::parseDate($date,'d.m.Y');
            }
        }
        $startDay = text::getDayWeekForDB($num_week,$year,0);
        $endDay = text::getDayWeekForDB($num_week,$year,6);
        $maxTime = $this->db->arrayResult("
        SELECT EXTRACT(HOUR FROM MAX(TIME(`datetime`)))
        FROM `schedule`
        WHERE DATE(`datetime`) >= '$startDay' AND DATE(`datetime`) <= '$endDay' AND `group`=$this->group;
        "); $maxTime = $maxTime[0];
        $minTime = $this->db->arrayResult("
        SELECT EXTRACT(HOUR FROM MIN(TIME(`datetime`)))
        FROM `schedule`
        WHERE DATE(`datetime`) >= '$startDay' AND DATE(`datetime`) <= '$endDay' AND `group`=$this->group;
        "); $minTime = $minTime[0];
        if (is_null($minTime) || is_null($maxTime)) {
            return null;
        }
        for ($i = $minTime; $i <= $maxTime;$i++) {
            $times[] = $i;
            for ($j = 0;$j<7;$j++) {
                $date = text::getDayWeekForDB($num_week,$year,$j);
                $query = "
                SELECT `id`
                FROM `schedule`
                WHERE DATE(`datetime`) = '$date' AND EXTRACT(HOUR FROM(`datetime`)) = $i AND `group`=$this->group;
                ";
                try {
                $res = $this->db->dArrayResult($query);
                } catch(Exception $ex) {
                    $lessons[$i-$minTime][] = null;
                }
                    $arr = array();
                    foreach ($res as $row) {
                        $arr[] = new lesson($row['id']);
                    }
                    $lessons[$i-$minTime][] = $arr;
            }
        }
        $lessons['hour'] = $times;
        $lessons['weekend'] = $weekends;
        return $lessons;
    }

    function getFollowingLessons($count = 7, $desc = false){
        $now = date('Y-m-d H:i:s');
        $query = "SELECT count(`id`) FROM `studinfo`.`schedule` WHERE `group` = $this->group AND `datetime` > '$now'";
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
        $query = "SELECT `id` FROM `studinfo`.`schedule` WHERE `group` = $this->group AND `datetime` > '$now'";
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

    function getPreviousLessons($count = 7,$desc = true){
        $now = date('Y-m-d H:i:s');
        $query = "  SELECT count(`id`) FROM `studinfo`.`schedule`
                    WHERE `group` = $this->group AND `datetime` < '$now'";
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
                    WHERE `group` = $this->group AND `datetime` < '$now'";
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
                    WHERE `student` = $studentId";
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
