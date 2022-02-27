<?php

namespace Osoobe\TelegramBot\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Osoobe\TelegramBot\Models\Message;
use Osoobe\TelegramBot\Traits\TelegramListenerTrait;

class TelegramListener
{

    use TelegramListenerTrait;
    
    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * 
     * @see https://laravel.com/docs/5.8/notifications#notification-events for handling general notification
     * @see https://github.com/laravel-notification-channels/telegram#handling-response for telegram notification
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        $this->telegramHandle($event);
    }
}
