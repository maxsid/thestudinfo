<?php
 class news {

    public $name, $description, $text, $date, $time, $author, $groups = array(), $confirmed;
    public $id, $db;

    function news($idNews = null)
    {
        $this->db = new db();
        if ($idNews != null)
        {
            $this->fillAdapterForId($idNews);
        }
    }

    public function fillAdapterForId($id)
    {
        $this->id = $id;
        $query = "SELECT `name`,`description`,`text`,`datetime`,`author`
                                          FROM `news` WHERE `id`=".$id.";";

        $res = $this->db->arrayResult($query);
        $this->name = $res['name'];
        $this->description = $res['description'];
        $this->text = $res['text'];
        
        $this->dateParse($res['datetime']);
        
        $this->author = $res['author'];
        $this->groups = $this->groupsForShow($id);
    }

     public function fillOnLatestNewsUser($userId)
     {
         $query = " SELECT `news`.`id`
                    FROM `news`
                    WHERE `news`.`author` = ".$userId."
                    ORDER BY `datetime` DESC;";

         $res = $this->db->singleResult($query);
         $this->fillAdapterForId($res);
     }

     public function groupsForShow($id)
     {
         $res = $this->db->arrayResult("SELECT `group` FROM `newsgroups` WHERE `news` = ".$id.";");
         return $res;
     }

    public function fillAdapterForAll($name,$description, $text,$author,$groups) {
        $this->name = $name;
        $this->description = $description;
        $this->text = $text;
        $this->author = $author;
        $this->groups = $groups;
    }

    public function refreshAdapter()
    {
        $this->fillAdapter($this->id);
    }

    public function hasAccess($groupId)
    {
        foreach ($this->groups as $row)
        {
            if ($row == $groupId)
                return true;
        }

        return false;
    }


    public function saveData()
    {
        try {
        if (!empty($this->id)) {
            $this->db->query( "UPDATE `news` SET `name`='".$this->name."', `description`='".$this->description."',
                                `text`='".$this->text."' WHERE `id`=".$this->id.";");
            $this->db->query(" DELETE FROM `newsgroups` WHERE `news`=".$this->id.";");
        } else {
            $now = date("Y-m-d H:i:s");
            $this->db->query("INSERT INTO `news` (`name`,`description`,`text`,`datetime`,`author`)
                          VALUES ('".$this->name."','".$this->description."','".$this->text."','".$now."',".$this->author.");");

            $this->id = $this->db->singleResult("
                                        SELECT `id` FROM `news`
                                        WHERE `datetime`='".$now."'
                                        AND `author`=".$this->author.";");

            foreach ($this->groups as $gr)
            {
                $this->db->query("INSERT INTO `newsgroups` (`news`,`group`) VALUES (".$this->id.",".$gr.");");
            }
        }
            return true;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function idNews()
    {
        if (!is_null($this->id))
        {
            return $this->id;
        } else
        {
            return null;
        }
    }

     public function dateParse($datetime)
     {
         $datetime = date_parse($datetime);
         $date = mktime(0,0,0,$datetime["month"],$datetime["day"],$datetime["year"]);
         $time = mktime($datetime["hour"],$datetime["minute"]);

         $this->date = date("d.m.Y",$date);
         $this->time = date("H:i",$time);
     }

     public function getDate()
     {
         $today = date("d.m.Y",mktime());
         $yesterday = date("d.m.Y", mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));

         switch ($this->date){
             case ($today):
                 return "Сегодня";
                 break;
             case ($yesterday):
                 return "Вчера";
                 break;
             default:
                 return $this->date;
                 break;
         };
     }


}