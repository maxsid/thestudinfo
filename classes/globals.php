<?php
/**
 * Created by PhpStorm.
 * User: Максим Сидоров
 * Date: 04.06.14
 * Time: 0:27
 */

class globals {

    static function getAllInstitutions($like = null){
        $db = new db();
        if (empty($like)) {
            $query = "SELECT `id` FROM `studinfo`.`institutions`;";
        } else {
            $query = "SELECT `id` FROM `studinfo`.`institutions` WHERE `name` LIKE '%$like%';";
        }
        $res = $db->dArrayResult($query);
        $institutions = array();
        foreach ($res as $inst){
            $institutions[] = new institut($inst['id']);
        }

        return $institutions;
    }
} 