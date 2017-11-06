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
        $this->FCM_SENDER_KEY = Config::get('fcm.FCM_SERVER_KEY');
        $this->FCM_SENDER_KEY = Config::get('fcm.FCM_SENDER_KEY');
        $this->FCM_URL_LEGACY = Config::get('fcm.FCM_URL_LEGACY');
    }

    public function send_messages(array $receivers, $title, $body){

        $body = json_encode([
            'registration_ids' => json_encode($receivers),
            'notification' => [
                'title' => $title,
                'body' => $body
            ]
        ]);

        $client = new Client([
            'headers' => [
                'Authorization' => 'key=' . $this->FCM_SERVER_KEY,
                'Content-type' => 'application/json'
            ]
        ]);

        $client->request('POST', $this->FCM_URL_LEGACY, [
            'body' => $body
        ]);
    }


}