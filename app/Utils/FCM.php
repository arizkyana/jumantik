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

    public function send_messages(array $receivers, $title, $body){

//        $body = json_encode([
//            'registration_ids' => $receivers,
//            'notification' => [
//                'title' => $title,
//                'body' => $body
//            ]
//        ]);
//
//
//        $client = new Client([
//            'base_uri' => $this->FCM_URL_LEGACY,
//            'headers' => [
//                'Authorization' => 'key=' . $this->FCM_SERVER_KEY,
//                'Content-type' => 'application/json'
//            ]
//        ]);
//
//        $client->post('send', [
//            'body' => $body
//        ]);

        $client = new \GuzzleHttp\Psr7\Request('POST', $this->FCM_URL_LEGACY);
        $client->post('send', $body);
        return json_encode((string) $client->getBody(), true);

        return json_encode((string) $client->getBody(), true);
    }


}