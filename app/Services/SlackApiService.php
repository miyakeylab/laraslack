<?php

namespace App\Services;

use GuzzleHttp\Client;

class SlackApiService
{

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     *
     * @param $message
     * @return mixed
     */
    public function postMessage($message)
    {

        $client = new Client([
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $response = $client->post(config('services.slack.error'),
            ['body' => $message]
        );
        logger($response->getBody());

        $data = json_decode($response->getBody()->getContents());

        return $data;
    }
}
