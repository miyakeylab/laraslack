<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

/**
 * Slack通知クラス
 */
class SlackSend extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Slack通知処理
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->from('Error通知おじさん', ':face_vomiting:')
            ->content(':face_vomiting: :face_vomiting: :face_vomiting:')
            ->attachment(function ($attachment)  {
                    $attachment->action('問題ないです', route('slack.response'), 'primary')
                        ->action('問題ありです', route('slack.response'), 'danger')
                        ->action('少々お待ちを', route('slack.response'))
                        ->content('This will be sent to #other2');
                });
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
