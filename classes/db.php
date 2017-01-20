<?php
class db {

    private $connect;

    function db()
    {
        $this->connect = mysql_connect ("localhost","studinfo","12qw34er");
        mysql_select_db ("studinfo",$this->connect);
        mysql_query('SET NAMES cp1251',$this->connect);
    }

    function singleResult($query) {
        $result = $this->arrayResult($query);
        return $result[0];
    }

    function arrayResult($query)
    {
        $result = mysql_query($query);
        $result = mysql_fetch_array($result);
        return $result;
    }

    function dArrayResult($query)
    {
        $result = mysql_query($query);
        $arr = array();
        while ($row = mysql_fetch_array($result))
            $arr[] = $row;

        return $arr;
    }

    function query($query) {
        mysql_query($query);
    }

    function countRow($query){
        $left = substr($query,0,strpos($query,'SELECT') + 6);
        $center = substr($query,strlen($left),strpos($query,'FROM') - strlen($left));
        $right = substr($query,strlen($center) + strlen($left));
        $query = $left." count(".$center.") ".$right;
        return $this->singleResult($query);
    }

    /**
     * Выполнение запроса выбора (SELECT) к БД.
     *
     * @param string|array $table
     * @param array|null|string $select
     * @param null|string $where
     * @param null|string $groupBy
     * @param null|string $orderBy
     * @return null
     */

    function SELECT($table, $select = "*", $where = null, $groupBy = null, $orderBy = null){
        $query = '';
        if (!empty($table)){
            $query = "SELECT ".$select." FROM ".$table." ";
            if (!empty($where)){
                $query .= "WHERE ".$where." ";
            }
            if (!empty($groupBy)){
                $query .= "GROUP BY ".$groupBy." ";
            }
            if (!empty($orderBy)){
                $query .= "ORDER BY ".$orderBy." ";
            }
        }
        return null;
    }


}