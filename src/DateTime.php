<?php

namespace PhangoApp\PhaTime;

class DateTime {

    /**
    * Basic format for 
    */

    static public $sql_format_time='YmdHis';
    
    static public $format_date='Y/m/d';
    
    static public $format_time='H:i:s';
    
    static public $timezone='Europe/Madrid';
    
    static public $ampm=false;
    
    /**
    * This method is for extract the elements of a basic time of DateTime class
    */
    
    static public function format_timedata($time)
    {
    
        $y=intval(substr($time, 0, 4));
        $m=intval(substr($time, 4, 2));
        $d=intval(substr($time, 6, 2));
        
        $h=intval(substr($time, 8, 2));
        $mi=intval(substr($time, 10, 2));
        $s=intval(substr($time, 12, 2));
        
        $ampm='';
        
        if(strlen($time)==16)
        {
        
            $ampm=substr($time, 14, 2);
        
        }
        
        switch($ampm)
        {
        
            case 'PM':
            case 'pm':

                if($h>0)
                {
                    $h=$h+12;
        
                }
            
            break;
        
        }
        
        //Check if the time and date is valid
        
        return [$y, $m, $d, $h, $mi, $s];
    
    }
    
    /**
    * This method extracs a YYYYmmddhhmmss in localtime
    */
    
    static public function obtain_timestamp($time)
    {
    
        list($y, $m, $d, $h, $mi, $s)=DateTime::format_timedata($time);
        
        if(checkdate($m, $d, $y) && ($h>=0 && $h<24) && ($mi>=0 && $mi<60) && ($s>=0 && $s<60))
        {
        
            return mktime($h, $mi, $s, $m, $d, $y);
            
        }
        else
        {
        
            return false;
        
        }
    
    }
    
    /**
    * Method for obtain the timestamp a obtain a valid formatted date
    */
    
    static public function format_datetime($format, $timestamp, $func_utc_return)
    {
    
        $timestamp=DateTime::obtain_timestamp($timestamp);
        
        if($timestamp)
        {
        
            $offset=date("Z");
            
            $timestamp=$func_utc_return($timestamp, $offset); 
            
            # Return utc
            
            return date($format, $timestamp);
            
        }
        else
        {
        
            return false;
        
        }
    
    }
    
    /**
    * This method extracs a YYYYmmddhhmmss in UTC
    */
    
    static public function local_to_gmt($time)
    {
    
        return DateTime::format_datetime(DateTime::$sql_format_time, $time, 'PhangoApp\PhaTime\substract_utc');
    
    }

    /**
    * This method format a YYYYmmddhhmmss UTC time
    */
    
    static public function format_time($time)
    {
    
        return DateTime::format_datetime(DateTime::$format_time, $time, 'PhangoApp\PhaTime\sum_utc');
    
    }
    
    /**
    * This method format a YYYYmmddhhmmss UTC date
    */
    
    static public function format_date($time)
    {
    
        return DateTime::format_datetime(DateTime::$format_date, $time, 'PhangoApp\PhaTime\sum_utc');
    
    }
    

}

function sum_utc($timestamp, $offset)
{

    return $timestamp+$offset;

}

function substract_utc($timestamp, $offset)
{

    return $timestamp-$offset;

}

?>