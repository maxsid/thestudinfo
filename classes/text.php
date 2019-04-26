<?php
class text {

    static function transliterate($input){
        $gost = array(
            "Є"=>"YE","І"=>"I","Ѓ"=>"G","і"=>"i","№"=>"-","є"=>"ye","ѓ"=>"g",
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G","Д"=>"D",
            "Е"=>"E","Ё"=>"YO","Ж"=>"ZH",
            "З"=>"Z","И"=>"I","Й"=>"J","К"=>"K","Л"=>"L",
            "М"=>"M","Н"=>"N","О"=>"O","П"=>"P","Р"=>"R",
            "С"=>"S","Т"=>"T","У"=>"U","Ф"=>"F","Х"=>"X",
            "Ц"=>"C","Ч"=>"CH","Ш"=>"SH","Щ"=>"SHH","Ъ"=>"'",
            "Ы"=>"Y","Ь"=>"","Э"=>"E","Ю"=>"YU","Я"=>"YA",
            "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
            "е"=>"e","ё"=>"yo","ж"=>"zh",
            "з"=>"z","и"=>"i","й"=>"j","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"x",
            "ц"=>"c","ч"=>"ch","ш"=>"sh","щ"=>"shh","ъ"=>"",
            "ы"=>"y","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
            " "=>"_","—"=>"_",","=>"_","!"=>"_","@"=>"_",
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
                if ($abbr)  { return 'Пн';}
                return 'Понедельник';
            case 2:
                if ($abbr)  { return 'Вт';}
                return 'Вторник';
            case 3:
                if ($abbr)  { return 'Ср';}
                return 'Среда';
            case 4:
                if ($abbr)  { return 'Чт';}
                return 'Четверг';
            case 5:
                if ($abbr)  { return 'Пт';}
                return 'Пятница';
            case 6:
                if ($abbr)  { return 'Сб';}
                return 'Суббота';
            case 7:
                if ($abbr)  { return 'Вс';}
                return 'Воскресение';
        }
        return null;
    }

    static function dayWeekOnNumWithSunday($numDay, $abbr = false)
    {
        switch ($numDay)
        {
            case 1:
                if ($abbr)  { return 'Пн';}
                return 'Понедельник';
            case 2:
                if ($abbr)  { return 'Вт';}
                return 'Вторник';
            case 3:
                if ($abbr)  { return 'Ср';}
                return 'Среда';
            case 4:
                if ($abbr)  { return 'Чт';}
                return 'Четверг';
            case 5:
                if ($abbr)  { return 'Пт';}
                return 'Пятница';
            case 6:
                if ($abbr)  { return 'Сб';}
                return 'Суббота';
            case 0:
                if ($abbr)  { return 'Вс';}
                return 'Воскресение';
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