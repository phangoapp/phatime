<?php

namespace PhangoApp\PhaTime;

class DateTime {

    static public $format_date='Y/m/d';
    
    static public $format_time='H:i:s';
    
    /**
    * This method extracs a YYYYmmddhhmmss UTC
    */
    
    static public function obtain_timestamp($time)
    {
    
        $y=intval(substr($time, 0, 4));
        $m=intval(substr($time, 4, 2));
        $d=intval(substr($time, 6, 2));
        
        $h=intval(substr($time, 8, 2));
        $mi=intval(substr($time, 10, 2));
        $s=intval(substr($time, 12, 2));
        
        
        return mktime($h, $mi, $s, $m, $d, $y);
    
    }

    /**
    * This method format a YYYYmmddhhmmss UTC time
    */
    
    static public function format_time($time)
    {
        
        $timestamp=DateTime::obtain_timestamp($time);
        
        $offset=date("Z");

        $timestamp=$timestamp+$offset; 
        
        # Return utc
        
        return date(DateTime::$format_time, $timestamp);
    
    }
    
    /**
    * This method format a YYYYmmddhhmmss UTC date
    */
    
    static public function format_date($time)
    {
    
        $timestamp=DateTime::obtain_timestamp($time);
        
        $offset=date("Z");

        $timestamp=$timestamp+$offset; 
    
        return date(DateTime::$format_date, $timestamp);
    
    }
    
    

}

?>