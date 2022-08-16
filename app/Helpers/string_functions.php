<?php

function splitString($string)
{
    $string_array = explode(' ', $string);
    $array_count = count($string_array);
    $first = '';
    $second = '';

    if ($array_count > 3) {
        // $string_array = array_slice($string_array, 0, $arr_count);
        $div_count = round(count($string_array) / 2);
        $fa = array_slice($string_array, 0, $div_count);
        $sa = array_slice($string_array, $div_count, $array_count);
        foreach ($fa as $fval) {
            $first .= $fval.' ';
        }
        foreach ($sa as $fval) {
            $second .= $fval.' ';
        }
    } else {
        $first = $string;
        $second = null;
    }

    return [$first, $second];
}

function in_use_message($string)
{
    $string_length = strlen($string);
    $first_half = substr($string, 0, $string_length / 2);
    $second_half = substr($string, $string_length / 2, $string_length);

    return [$first_half, $second_half];
}
