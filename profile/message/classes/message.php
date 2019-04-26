<?php
class message {

    public $id, $title, $message, $date, $time, $author, $recipients = array(), $read = array();
    private $db;

    function message($id = null)
    {
        $this->db = new db();
        if ($id != null)
            $this->fillOnId($id);
    }

    function fullForSend($author, $title, $message, $recipients)
    {
        $this->author = $author;
        $this->title = $title;
        $this->message = $message;
        $this->recipients = $recipients;
    }

    function fillAndSend($author, $title, $message, $recipients)
    {
        $this->author = $author;
        $this->title = $title;
        $this->message = $message;
        $this->recipients = $recipients;
        $this->sendMessages();
    }

    function fillOnId($messageId)
    {
        $this->id = $messageId;

        $query = "SELECT *
                  FROM `message`
                  WHERE `id`=".$messageId.";";
        $res = $this->db->arrayResult($query);

        $this->author = $res['author'];
        $this->title = $res['title'];
        $this->message = $res['text'];
        $this->dateParse($res['datetime']);
        $this->fillRecipients($messageId);
    }

    function fillRecipients($messageId)
    {
        $query = "SELECT `recipient`,`read`
                  FROM `messagereaders`
                  WHERE `message`=".$messageId.";";
        $res = $this->db->dArrayResult($query);
        foreach ($res as $row)
        {
            $this->recipients[] = $row['recipient'];
            $this->read[] = (boolean) $row['read'];
        }
    }

    function setReading($userId)
    {
        $query = "  UPDATE `messagereaders` SET `read`=1
                            WHERE `message`=".$this->id." AND `recipient`=".$userId.";";
        $this->db->query($query);
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

    public function hasAccess($userId)
    {
        foreach ($this->recipients as $row)
        {
            if ($row == $userId)
                return true;
        }
        if ($this->author == $userId)
            return true;

        return false;
    }

    public function latestAuthorMessage()
    {
        $query = "  SELECT `id` FROM `message`
                    WHERE `author`=".$this->author."
                    ORDER BY `datetime` DESC;";
        $res = $this->db->arrayResult($query);
        return $res['id'];
    }

    public function sendMessages()
    {
        try
        {
            $query = "INSERT INTO `message` (`title`,`text`,`datetime`,`author`)
                        VALUES ('".$this->title."','".$this->message."',NOW(),".$this->author.");";
                        $this->db->query($query);
            $this->id = $this->latestAuthorMessage();
            foreach ($this->recipients as $rec)
            {
                $this->db->query("INSERT INTO `messagereaders` (`message`,`recipient`)
                   VALUES (".$this->id.",".$rec.")");
            }
            return true;
        } catch (Exception $ex)
        {
            return false;
        }
    }

    function getAuthor(){
        return new user($this->author);
    }

    function readForUserId($userId)
    {
        foreach ($this->recipients as $key=>$row)
        {
            if ($row == $userId)
            {
                return (boolean) $this->read[$key];
            }
        }
    }
} 