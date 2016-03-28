<?php

// Helper takes the 
function url_with_get($url, $array)
{
    if(!isset($array) || count($array) < 1)
        return $url;

    $getParameters = '';
    $appendAnd = '';
    $needToAppend = false;
    foreach($array as $key => $val){
        if($needToAppend){
            $appendAnd = '&';
        }else{
            $needToAppend = true;
        }
        $getParameters = $getParameters . $appendAnd . $key . '=' . $val;
    }
    return $url . '?' . $getParameters;
}