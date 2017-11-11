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

}