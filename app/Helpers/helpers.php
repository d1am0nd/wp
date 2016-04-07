<?php

// Helper takes the 
function url_with_get($url, $array)
{
    if(!isset($array) || count($array) < 1)
        return $url;

    $getParameters = http_build_query($array);
    
    return $url . '?' . $getParameters;
}

function remove_http($string)
{
    if(starts_with($string, 'http://'))
        return substr($string, 7, strlen($string));
    elseif(starts_with($string, 'https://'))
        return substr($string, 8, strlen($string));
    return $string;
}