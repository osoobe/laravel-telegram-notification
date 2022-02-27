<?php

namespace Osoobe\TelegramBot\Traits;

use Illuminate\Notifications\Events\NotificationSent;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;
use Osoobe\TelegramBot\Models\Message;

trait TelegramListenerTrait {


    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * 
     * @see https://laravel.com/docs/5.8/notifications#notification-events for handling general notification
     * @see https://github.com/laravel-notification-channels/telegram#handling-response for telegram notification
     * @return void
     */
    protected function telegramHandle(NotificationSent $event, $model=null)
    {

        if ( $event->channel == TelegramChannel::class ) {

            if ( empty($model) ) {
                if ( method_exists($event->notification, 'getPerformedOn') ) {
                    $model = $event->notification->getPerformedOn();
                }   
            }

            $response = $event->response;
            $chat_name = $response['result']['chat']['title']." ".$response['result']['chat']['type'];

            $response_data = [
                'name' => $chat_name,
                'content' => "Message successful sent to ".$chat_name,
                'data' => $response,
                'success' => (int) ( (bool) $response['ok'] )
            ];

            if ( !empty($model) ) {
                $response_data['model_type'] = get_class($model);
                $response_data['model_id'] = $model->id;
            }

            Message::updateOrCreate([
                'chat_id' => $response['result']['chat']['id'],
                'message_id' => $response['result']['message_id'],
            ], $response_data);

        }
    }


}

?>