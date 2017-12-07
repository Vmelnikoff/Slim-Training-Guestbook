<?php


namespace App;


class App
{
    public static function getIP(array $serverParams)
    {
        if (!empty($serverParams['HTTP_CLIENT_IP'])) {
            return $serverParams['HTTP_CLIENT_IP'];
        } elseif (!empty($serverParams['HTTP_X_FORWARDED_FOR'])) {
            return $serverParams['HTTP_X_FORWARDED_FOR'];
        } else {
            return $serverParams['REMOTE_ADDR'];
        }
    }

}