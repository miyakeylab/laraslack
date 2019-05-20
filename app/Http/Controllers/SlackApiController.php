<?php

namespace App\Http\Controllers;

use App\Services\SlackApiService;
use Illuminate\Http\Request;

class SlackApiController extends Controller
{
    private $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SlackApiService $service)
    {
        $this->service = $service;
    }
    /**
     * @param Request $request
     * @return void
     */
    public function sendSlack(Request $request)
    {
        // $message = "API_URL_TEST";
        $message = "＊本社受付＊ に、 ＊テスト＊ の ＊・テスト＊ 様が ＊1＊ 名で来られました。\n
お迎えに行く時は「OK」を押してから行きましょう。";

        $data = array(
            "text" => $message
        );

        $actions =
            [   "name" => "game",
                'type' => "button",
                'text' => "迎えに行く",
                "value" => "chess"
            ];

        $data += [
            "attachments" =>
                [
                    [   "callback_id" => "wopr_game",
                        "fallback" => "More details...", //I only get the message and this text in the slack
                        'actions' => [$actions] // or array($actions)

                    ]
                ]
        ];

        $payload = json_encode($data);
//
//        print_r($payload);

//        $message = "こんにちわ?";
//        $data = json_encode( [ 'text' => $message ] );
        $return = $this->service->postMessage($payload);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function receiveSlack(Request $request)
    {
        logger($request);
        $temp = json_encode($request['payload'], true);
        logger($temp);
        $temp['original_message']['text'] = $temp['user']['name'] . ' :ok_hand: がお迎えに行きます';
        return response($temp['original_message']);
        //return response()->json(['user'=>$temp['user']['name']]);
    }
}
