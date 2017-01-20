<?php
class someMessages {

    public  $incoming = array(), $outcoming = array(), $user;
    private $db;
    function someMessages($userId)
    {
        $this->db = new db();
        $this->user = $userId;
        $this->fill();
    }

    function fill()
    {
        $query = "SELECT `message`.`id`
                  FROM `message` LEFT OUTER JOIN `messagereaders`
                  ON `message`.`id`=`messagereaders`.`message`
                  WHERE `messagereaders`.`recipient`=".$this->user."
                  ORDER BY `message`.`datetime` DESC;";
        $res = $this->db->dArrayResult($query);

        foreach ($res as $row)
        {
            $this->incoming[] = new message($row['id']);
        }
        $query = "SELECT `id`
                  FROM `message`
                  WHERE `author`=".$this->user."
                  ORDER BY `datetime` DESC;";
        $res = $this->db->dArrayResult($query);

        foreach ($res as $row)
        {
            $this->outcoming[] = new message($row['id']);
        }
    }

    function countIncoming()
    {
        return count($this->incoming);
    }

    function  countOutcoming()
    {
        return count($this->outcoming);
    }

    function countNewIncoming()
    {
        $count = 0;
        foreach ($this->incoming as $mes)
        {
            if (!$mes->readForUserId($this->user)) $count++;
        }
        return $count;
    }

    function getLinkIncomingMessage($numMessage)
    {
        $link = &$this->incoming[$numMessage];
        return $link;
    }
} 