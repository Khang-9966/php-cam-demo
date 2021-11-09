<?php


namespace App\Helpers;


use Ixudra\Curl\Facades\Curl;

class API
{
    public static function callAPI($uri, $method, $params = array(), $headers = array()) {
        return Curl::to($uri)
            ->withData($params)
            ->withHeaders($headers)
            ->asJsonResponse()
            ->$method();
    }
}
