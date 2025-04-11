<?php

if (!function_exists('toKhmerNumber')) {
    function toKhmerNumber($number)
    {
        return strtr($number, [
            '0' => '០',
            '1' => '១',
            '2' => '២',
            '3' => '៣',
            '4' => '៤',
            '5' => '៥',
            '6' => '៦',
            '7' => '៧',
            '8' => '៨',
            '9' => '៩'
        ]);
    }
}
