<?php
class text {

    static function transliterate($input){
        $gost = array(
            "�"=>"YE","�"=>"I","�"=>"G","�"=>"i","�"=>"-","�"=>"ye","�"=>"g",
            "�"=>"A","�"=>"B","�"=>"V","�"=>"G","�"=>"D",
            "�"=>"E","�"=>"YO","�"=>"ZH",
            "�"=>"Z","�"=>"I","�"=>"J","�"=>"K","�"=>"L",
            "�"=>"M","�"=>"N","�"=>"O","�"=>"P","�"=>"R",
            "�"=>"S","�"=>"T","�"=>"U","�"=>"F","�"=>"X",
            "�"=>"C","�"=>"CH","�"=>"SH","�"=>"SHH","�"=>"'",
            "�"=>"Y","�"=>"","�"=>"E","�"=>"YU","�"=>"YA",
            "�"=>"a","�"=>"b","�"=>"v","�"=>"g","�"=>"d",
            "�"=>"e","�"=>"yo","�"=>"zh",
            "�"=>"z","�"=>"i","�"=>"j","�"=>"k","�"=>"l",
            "�"=>"m","�"=>"n","�"=>"o","�"=>"p","�"=>"r",
            "�"=>"s","�"=>"t","�"=>"u","�"=>"f","�"=>"x",
            "�"=>"c","�"=>"ch","�"=>"sh","�"=>"shh","�"=>"",
            "�"=>"y","�"=>"","�"=>"e","�"=>"yu","�"=>"ya",
            " "=>"_","�"=>"_",","=>"_","!"=>"_","@"=>"_",
            "#"=>"-","$"=>"","%"=>"","^"=>"","&"=>"","*"=>"",
            "("=>"",")"=>"","+"=>"","="=>"",";"=>"",":"=>"",
            "'"=>"","\""=>"","~"=>"","`"=>"","?"=>"","/"=>"",
            "\\"=>"","["=>"","]"=>"","{"=>"","}"=>"","|"=>""
        );
    return strtr($input, $gost);
    }

    static function encoding($string)
    {
        return sha1(md5(strrev(md5($string))));
    }

    static function generate($length = null, $symbols = null)
    {
        if (empty($symbols))
        {
            $symbols ="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        }
        if (empty($length))
        {
            $length = 10;
        }
            $size=StrLen($symbols)-1;
            $password=null;

            while($length--)
                $password.=$symbols[rand(0,$size)];

        return $password;
    }

    static function dayWeekOnNumDayWeek($numDay, $abbr = false)
    {
        switch ($numDay)
        {
            case 1:
                if ($abbr)  { return '��';}
                return '�����������';
            case 2:
                if ($abbr)  { return '��';}
                return '�������';
            case 3:
                if ($abbr)  { return '��';}
                return '�����';
            case 4:
                if ($abbr)  { return '��';}
                return '�������';
            case 5:
                if ($abbr)  { return '��';}
                return '�������';
            case 6:
                if ($abbr)  { return '��';}
                return '�������';
            case 7:
                if ($abbr)  { return '��';}
                return '�����������';
        }
        return null;
    }

    static function dayWeekOnNumWithSunday($numDay, $abbr = false)
    {
        switch ($numDay)
        {
            case 1:
                if ($abbr)  { return '��';}
                return '�����������';
            case 2:
                if ($abbr)  { return '��';}
                return '�������';
            case 3:
                if ($abbr)  { return '��';}
                return '�����';
            case 4:
                if ($abbr)  { return '��';}
                return '�������';
            case 5:
                if ($abbr)  { return '��';}
                return '�������';
            case 6:
                if ($abbr)  { return '��';}
                return '�������';
            case 0:
                if ($abbr)  { return '��';}
                return '�����������';
        }
        return null;
    }

    static function getDayWeek($_week_number, $_year, $_day_week)
    {
        $numDayWeek = date('w',mktime(0,0,0,1,1,$_year)) - 1;
        $daysToWeek = ($_week_number - 1) * 7;
        return date('d.m.Y',mktime(0,0,0,1,1 - ($numDayWeek) + $daysToWeek + $_day_week,$_year));
    }
    static function getDayWeekForDB($_week_number, $_year, $_day_week)
    {
        $numDayWeek = date('w',mktime(0,0,0,1,1,$_year)) - 1;
        $daysToWeek = ($_week_number - 1) * 7;
        return date('Y-m-d',mktime(0,0,0,1,1 - ($numDayWeek) + $daysToWeek + $_day_week,$_year));
    }

    static function parseDate($date,$format = 'Y-m-d')
    {
        $date = date_parse($date);
        $date = mktime($date['hour'],$date['minute'],$date['second'],$date["month"],$date["day"],$date["year"]);
        return date($format,$date);
    }
} 