<?php
class anyNews {

    public $groupNews = array();
    private $db;

    public function anyNews($group, $orderBy = "datetime", $asc = false)
    {
        $this->db = new db();
        $orderBy = "`".$orderBy."`";
        $orderBy = $asc ? $orderBy : $orderBy." DESC";
        $query = "  SELECT `news`.`id`
                    FROM `news` LEFT OUTER JOIN `newsgroups`
                    ON `news`.`id` = `newsgroups`.`news`
                    WHERE `newsgroups`.`group` = ".$group."
                    ORDER BY ".$orderBy.";";


        $result = $this->db->dArrayResult($query);

        foreach ($result as $row)
        {
            $id = $row['id'];
            $this->groupNews[] = new news($id);
        }

    }

    public function getCount()
    {
        return count($this->groupNews);
    }
} 