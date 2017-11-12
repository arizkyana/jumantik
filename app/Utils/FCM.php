<?php
/**
 * Created by PhpStorm.
 * User: agung
 * Date: 11/4/2017
 * Time: 19:50
 */

namespace App\Utils;


use Illuminate\Support\Facades\Config;
use GuzzleHttp\Client;

class FCM
{
    private $FCM_SERVER_KEY;
    private $FCM_SENDER_KEY;
    private $FCM_URL_LEGACY;

    public function __construct()
    {
        $this->FCM_SERVER_KEY = Config::get('fcm.FCM_SERVER_KEY');
        $this->FCM_SENDER_KEY = Config::get('fcm.FCM_SENDER_KEY');
        $this->FCM_URL_LEGACY = Config::get('fcm.FCM_URL_LEGACY');
    }

    public function send_messages(array $receivers, $title, $body)
    {

        $body = json_encode([
            'registration_ids' => $receivers,
            'notification' => [
                'title' => $title,
                'body' => $body
            ]
        ]);


        $fields = array(
            'registration_ids' => $receivers,
            'notification' => [
                'title' => $title,
                'icon' => 'jumantik'
            ],
            'data' => array(
                "message" => $body
            )
        );
        $fields = json_encode($fields);

        $headers = array(
            'Authorization: key=' . $this->FCM_SERVER_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->FCM_URL_LEGACY . 'send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


}