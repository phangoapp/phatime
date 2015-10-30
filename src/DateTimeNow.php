<?php

namespace PhangoApp\PhaTime;

/**
*
* Actual timestamp
*
*/

define("TODAY", mktime( date('H'), date('i'), date('s') ) );

/**
*
* Timestamp today to 00:00:00 hours
*
*/

define("TODAY_FIRST", mktime(0, 0, 0));

/**
*
* Timestamp today to 23:59:59 hours
*
*/

define("TODAY_LAST", mktime(23, 59, 59));

/**
*
* Timestamp today in this hour
*
*/

define("TODAY_HOUR", mktime(date('H'), 0, 0));

class DateTimeNow {

    static public $today=TODAY;
    static public $today_first=TODAY_FIRST;
    static public $today_last=TODAY_LAST;
    static public $today_hour=TODAY_HOUR;
    
    static public function update_datetime()
    {
    
        DateTimeNow::$today=mktime( date('H'), date('i'), date('s') );
        DateTimeNow::$today_first=mktime(0, 0, 0);
        DateTimeNow::$today_last=mktime(23, 59, 59);
        DateTimeNow::$today_hour=mktime(date('H'), 0, 0);
    
    }
    
}

?>