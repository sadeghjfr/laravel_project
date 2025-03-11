<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = '%A, %d %B %Y')
{
    return Jalalian::forge($date)->format($format);
}

function convertPersianToEnglish($number) {

    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    return str_replace($persianDigits, $englishDigits, $number);
}

function convertEnglishToPersian($number) {

    $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

    return str_replace($englishDigits, $persianDigits, $number);
}

function priceFormat($price)
{
    $price = number_format($price);
    $price = convertEnglishToPersian($price);
    return $price;
}

