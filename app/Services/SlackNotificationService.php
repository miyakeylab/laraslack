<?php
namespace App\Services;

use App\Notifications\SlackSend;
use Illuminate\Notifications\Notifiable;

class SlackNotificationService
{

    use Notifiable;

    /**
     * SlackチャンネルのWebhookURLを返す
     *
     * @return string
     */
    public function routeNotificationForSlack()
    {
        return config('services.slack.error');
    }

    /**
     * 送信メソッド
     *
     * @param string $hookUrl slackのwebhook用URL
     * @param object $message slackMessage用Object
     * @return void
     */
    public function send()
    {
        try{
            // ログイン通知
            $this->notify(new SlackSend());
        }catch(\Exception $e){
            logger($e);
        }
    }
}
