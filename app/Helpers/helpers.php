<?php

// Helper takes the 
function url_with_get($url, $array)
{
    if(!isset($array) || count($array) < 1)
        return $url;

    $getParameters = http_build_query($array);
    
    return $url . '?' . $getParameters;
}