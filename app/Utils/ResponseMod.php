<?php
/**
 * Created by PhpStorm.
 * User: agungrizkyana
 * Date: 11/11/17
 * Time: 18:56
 */

namespace App\Utils;


class ResponseMod
{
    public function __construct()
    {
    }

    public static function failed($data){
        return [
            'status' => 0,
            'data' => $data
        ];
    }

    public static function success($data){
        return [
            'status' => 1,
            'data' => $data
        ];
    }

    public function curl($url, $method, $headers, $body = "", $port = 8081)
    {
        $data = $body;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);

        return $result;
    }

}