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

if (!function_exists('formatKhmerDate')) {
    function formatKhmerDate($date)
    {
        $days = ['អាទិត្យ', 'ច័ន្ទ', 'អង្គារ', 'ពុធ', 'ព្រហ', 'សុក្រ', 'សៅរ៍'];
        $months = [
            '',
            'មករា',
            'កុម្ភៈ',
            'មីនា',
            'មេសា',
            'ឧសភា',
            'មិថុនា',
            'កក្កដា',
            'សីហា',
            'កញ្ញា',
            'តុលា',
            'វិច្ឆិកា',
            'ធ្នូ'
        ];

        $carbon = \Carbon\Carbon::parse($date);
        $day = $days[$carbon->dayOfWeek];
        $dayNum = toKhmerNumber($carbon->day);
        $month = $months[$carbon->month];
        $year = toKhmerNumber($carbon->year);

        return "ថ្ងៃទី{$dayNum} ខែ{$month} ឆ្នាំ{$year}";
    }
}

if (!function_exists("formatDate")) {
    function formatDate($date, $format = 'd-M-Y')
    {
        return \Carbon\Carbon::parse($date)->translatedFormat($format);
    }
}
