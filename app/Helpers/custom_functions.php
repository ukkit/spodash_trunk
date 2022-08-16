<?php

function isNullOrEmpty($s)
{
    return ! isset($s) || trim($s) == '';
}

function add_hrs($array)
{
    $returnVal = null;
    $sum = 0;
    $hours = 0;
    $minutes = 0;
    $seconds = 0;
    $fgsum = 0;
    if (count($array) > 0) {
        foreach ($array as $fval) {
            $exploded = explode(':', $fval);
            $sum = $exploded[0] * 60 * 60 + $exploded[1] * 60 + $exploded[2];
            $fgsum = $fgsum + $sum;
        }
        if ($fgsum < 24 * 60 * 60) {
            $returnVal = gmdate('H:i:s', $fgsum);
        } else {
            $hours = floor($fgsum / 3600);
            $minutes = floor(($fgsum - $hours * 3600) / 60);
            $seconds = floor($fgsum - ($hours * 3600) - ($minutes * 60));
            $returnVal = "$hours:$minutes:$seconds";
        }
    }

    return $returnVal;
}

function fail_hours($rec_count, $array)
{
    // echo "Fail Count: $rec_count | Array count: ".count($array);
    $fail = null;
    $sum = 0;
    $hours = 0;
    $minutes = 0;
    $seconds = 0;
    $fgsum = 0;
    if ($rec_count > 0) {
        foreach ($array as $fval) {
            $exploded = explode(':', $fval);
            $sum = $exploded[0] * 60 * 60 + $exploded[1] * 60 + $exploded[2];
            $fgsum = $fgsum + $sum;
        }
        if ($fgsum < 24 * 60 * 60) {
            $fail = gmdate('H:i:s', $fgsum);
        } else {
            $hours = floor($fgsum / 3600);
            $minutes = floor(($fgsum - $hours * 3600) / 60);
            $seconds = floor($fgsum - ($hours * 3600) - ($minutes * 60));
            $fail = "$hours:$minutes:$seconds";
        }
    }

    return $fail;
}

function total_add($var1, $var2, $var3)
{
    // echo count($var1)."=".count($var2)."=".count($var3)."\n";
    if (! is_null($var1)) {
        $exp1 = explode(':', $var1);
        $sum1 = $exp1[0] * 60 * 60 + $exp1[1] * 60 + $exp1[2];
    } else {
        $sum1 = 0;
    }
    if (! is_null($var2)) {
        $exp2 = explode(':', $var2);
        $sum2 = $exp2[0] * 60 * 60 + $exp2[1] * 60 + $exp2[2];
    } else {
        $sum2 = 0;
    }
    if (! is_null($var3)) {
        $exp3 = explode(':', $var3);
        $sum3 = $exp3[0] * 60 * 60 + $exp3[1] * 60 + $exp3[2];
    } else {
        $sum3 = 0;
    }
    $superSum = $sum1 + $sum2 + $sum3;
    $hours = floor($superSum / 3600);
    $minutes = floor(($superSum - $hours * 3600) / 60);
    $seconds = floor($superSum - ($hours * 3600) - ($minutes * 60));

    $rv = $hours.':'.$minutes.':'.$seconds;

    return $rv;
}

function max_min_avg_total($array1, $array2)
{
    $array = array_merge($array1, $array2);
    // echo count($array1)." - ". count($array2)." - ".count($array)." <<==";
    if (count($array) < 1) {
        $max = null;
        $min = null;
        $avg = null;
        $total = null;
        $gsum = 0;
        $average = 0;
    } else {
        $gsum = 0;
        $sum = 0;
        $avg = 0;
        $total = 0;
        $max = max($array);
        $min = min($array);
        foreach ($array as $val) {
            $exploded = explode(':', $val);
            $sum = $exploded[0] * 60 * 60 + $exploded[1] * 60 + $exploded[2];
            $gsum = $gsum + $sum;
            // echo $val." / ";
        }
        $average = $gsum / count($array);
        if ($average < 24 * 60 * 60) {
            $avg = gmdate('H:i:s', $average);
        } else {
            $hrs = floor($average / 3600);
            $min = floor(($average - $hours * 3600) / 60);
            $sec = floor($average - ($hours * 3600) - ($minutes * 60));
            $avg = "$hrs:$min:$sec";
        }
        if ($gsum < 24 * 60 * 60) {
            $total = gmdate('H:i:s', $gsum);
        } else {
            $hours = floor($gsum / 3600);
            $minutes = floor(($gsum - $hours * 3600) / 60);
            $seconds = floor($gsum - ($hours * 3600) - ($minutes * 60));
            $total = "$hours:$minutes:$seconds";
        }
    }
    // echo "Max: $max, Min: $min, Avg: $avg, Total: $total GSUM: $gsum AVG: $average FAIL: $fail";
    return [$max, $min, $avg, $total];
}

function add_everything($var1, $var2, $var3, $var4, $var5, $var6)
{
    if (! is_null($var1)) {
        $exp1 = explode(':', $var1);
        $sum1 = $exp1[0] * 60 * 60 + $exp1[1] * 60 + $exp1[2];
    } else {
        $sum1 = 0;
    }
    if (! is_null($var2)) {
        $exp2 = explode(':', $var2);
        $sum2 = $exp2[0] * 60 * 60 + $exp2[1] * 60 + $exp2[2];
    } else {
        $sum2 = 0;
    }
    if (! is_null($var3)) {
        $exp3 = explode(':', $var3);
        $sum3 = $exp3[0] * 60 * 60 + $exp3[1] * 60 + $exp3[2];
    } else {
        $sum3 = 0;
    }
    if (! is_null($var4)) {
        $exp4 = explode(':', $var4);
        $sum4 = $exp4[0] * 60 * 60 + $exp4[1] * 60 + $exp4[2];
    } else {
        $sum4 = 0;
    }
    if (! is_null($var5)) {
        $exp5 = explode(':', $var5);
        $sum5 = $exp5[0] * 60 * 60 + $exp5[1] * 60 + $exp5[2];
    } else {
        $sum5 = 0;
    }
    if (! is_null($var6)) {
        $exp6 = explode(':', $var6);
        $sum6 = $exp6[0] * 60 * 60 + $exp6[1] * 60 + $exp6[2];
    } else {
        $sum6 = 0;
    }
    $superSum = $sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6;
    $hours = floor($superSum / 3600);
    $minutes = floor(($superSum - $hours * 3600) / 60);
    $seconds = floor($superSum - ($hours * 3600) - ($minutes * 60));

    $rv = $hours.':'.$minutes.':'.$seconds;

    return $rv;
}

function get_action_text($action)
{
    switch ($action) {
        case 'StartAppServer':
            $action_text = 'Start Server';
            break;
        case 'ShutDownAppServer':
            $action_text = 'Stop Server';
            break;
        case 'Restart':
            $action_text = 'Restart Server';
            break;
        case 'SPO_upgrade':
            $action_text = 'SPM Upgrade';
            break;
        case 'SF_upgrade':
            $action_text = 'Snowflake Upgrade';
            break;
        case 'PAI_upgrade':
            $action_text = 'PAI Upgrade';
            break;
        case 'BuildUpdate':
            $action_text = 'SPM & PAI Upgrade';
            break;
        case 'SPM_PAI_upgrade':
            $action_text = 'SPM & PAI Upgrade';
            break;
        case 'SPM_SF_upgrade':
            $action_text = 'SPM & Snowflake Upgrade';
            break;
        default:
            $action_text = 'Build Update';
    }

    return $action_text;
}

function url_test($url)
{
    $timeout = 15; // INCREASED THIS TO 15 FROM 10
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $http_respond = curl_exec($ch);
    $http_respond = trim(strip_tags($http_respond));
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (($http_code == '200') || ($http_code == '302')) {
        return true;
    } else {
        // you can return $http_code here if necessary or wanted
        return false;
    }
    curl_close($ch);
}
