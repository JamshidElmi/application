<?php
/**
 * Created by PhpStorm.
 * Convert Number to Charecters Method
 * User: Jamshid Elmi
 * Date: 12/21/2017
 * Time: 8:03 PM
 */

function number2letters($strnum)
{

    $size_e = strlen($strnum);

    for ($i = 0; $i < $size_e; $i++) {
        if (!($strnum [$i] >= "0" && $strnum [$i] <= "9")) {
            die ("content of string must be number. " . 'فقط عدد وارد کنید');

        }
    }

    for ($i = 0; $i < $size_e && $strnum [$i] == "0"; $i++)
        ;

    $str = substr($strnum, $i);
    $size = strlen($str);

    $arr = array();
    $res = "";
    $mod = $size % 3;
    if ($mod) {
        $arr [] = substr($str, 0, $mod);
    }

    for ($j = $mod; $j < $size; $j += 3) {
        $arr [] = substr($str, $j, 3);
    }

    $arr1 = array("", "یک", "دو", "سه", "چهار", "پنج", "شش", "هفت", "هشت", "نه");
    $arr2 = array(1 => "یازده", "دوازده", "سیزده", "چهارده", "پانزده", "شانزده", "هفده", "هجده", "نوزده");
    $arr3 = array(1 => "ده", "بیست", "سی", "چهل", "پنجاه", "شصت", "هفتاد", "هشتاد", "نود");
    $arr4 = array(1 => "یکصد", "دوصد", "سه صد", "چهارصد", "پنج صد", "ششصد", "هفتصد", "هشتصد", "نهصد");
    $arr5 = array(1 => "هزار", "میلیون", " میلیارد", " تیلیارد");
    $explode = 'و';
    $size_arr = count($arr);

    if ($size_arr > count($arr5) + 1) {
        die ("عدد بسیار بزرگ است . " . 'this number is greate');

    }

    for ($i = 0; $i < $size_arr; $i++) {

        $flag_2 = 0;
        $flag_1 = 0;

        if ($i) {
            $res .= ' ' . $explode . ' ';
        }

        $p = $arr [$i];
        $ss = strlen($p);

        for ($k = 0; $k < $ss; $k++) {
            if ($p [$k] != "0") {
                break;
            }
        }

        $p = substr($p, $k);
        $size_p = strlen($p);

        if ($size_p == 3) {
            $res .= $arr4 [( int )$p [0]];
            $p = substr($p, 1);
            $size_p = strlen($p);

            if ($p [0] == "0") {
                $p = substr($p, 1);
                $size_p = strlen($p);
                if ($p [0] == "0") {
                    continue;
                } else {
                    $flag_1 = 1;
                }

            } else {
                $flag_2 = 1;
            }

        }

        if ($size_p == 2) {

            if ($flag_2) {
                $res .= ' ' . $explode . ' ';
            }

            if ($p >= "0" && $p <= "9") {
                $res .= $arr1 [( int )$p];
            } elseif ($p >= "11" && $p <= "19") {
                $res .= $arr2 [( int )$p [1]];
            } elseif ($p [0] >= "1" && $p [0] <= "9" && $p [1] == "0") {
                $res .= $arr3 [( int )$p [0]];
            } else {
                $res .= $arr3 [( int )$p [0]];
                $res .= ' ' . $explode . ' ';
                $res .= $arr1 [( int )$p [1]];
            }

        }

        if ($size_p == 1) {

            if ($flag_1) {
                $res .= ' ' . $explode . ' ';
            }

            $res .= $arr1 [( int )$p];

        }

        if ($i + 1 < $size_arr) {
            $res .= ' ' . $arr5 [$size_arr - $i - 1];
        }

    }

    return ($res);
}



