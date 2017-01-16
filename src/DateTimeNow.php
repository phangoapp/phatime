<?php

namespace PhangoApp\PhaTime;


/**
*
* Timestamp today in this hour
*
*/

define("TODAY_HOUR", mktime(date('H'), 0, 0));

class DateTimeNow {

    static public $today='';
    static public $today_first='';
    static public $today_last='';
    static public $today_hour='';
    
    static public function update_datetime()
    {
    
        DateTimeNow::$today=DateTime::format(DateTime::now(false), 'His');
        DateTimeNow::$today_first=DateTime::format(DateTime::now(false), 'Ymd000000');
        DateTimeNow::$today_last=DateTime::format(DateTime::now(false), 'Ymd235959');
        DateTimeNow::$today_hour=DateTime::format(DateTime::now(false), 'H0000');
    
    }
    
}

DateTimeNow::update_datetime();

?>
