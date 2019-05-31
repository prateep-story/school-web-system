<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Optional;
use Illuminate\Support\Collection;
use Illuminate\Support\Debug\Dumper;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HigherOrderTapProxy;

if (! function_exists('slug_th')) {
    function slug_th($string)
    {
        $string = strtolower(trim($string));
        $string = preg_replace('~[^a-z0-9ก-๙\.\-\_]~iu', '-', $string);
        $string = preg_replace('/-+/', "-", $string);
        return $string;
    }

    function date_th($str_date)
    {
        $str_year = date("Y", strtotime($str_date))+543;
        $str_month= date("n", strtotime($str_date));
        $str_day= date("j", strtotime($str_date));
        $str_month_cut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $str_month_thai=$str_month_cut[$str_month];
        return "$str_day $str_month_thai $str_year";
    }

    function time_th($str_date)
    {
        $str_hour= date("H", strtotime($str_date));
        $str_minute= date("i", strtotime($str_date));
        $str_seconds= date("s", strtotime($str_date));
        $text = "น.";
        return "$str_hour:$str_minute $text";
    }

    function year_th($str_date)
    {
        $str_year = date("Y", strtotime($str_date))+543;
        return $str_year;
    }

    function month_th($str_date)
    {
        $str_month= date("n", strtotime($str_date));
        $str_month_cut = array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $str_month_thai=$str_month_cut[$str_month];
        return $str_month_thai;
    }
    function day_th($str_date)
    {
        $str_day= date("j", strtotime($str_date));
        return $str_day;
    }
}
