<?php

namespace Osoobe\TelegramBot\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use Osoobe\TelegramBot\Traits\TelegramNotificationTrait;


class TelegramNotification extends Notification {
    use Queueable;
    use TelegramNotificationTrait;

    protected $message;
    protected $context;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $subject='Notification', $chat_id=null, $token=null)
    {
        $this->setupTelegram($chat_id, $token);
        $this->message = $message;
        $this->subject = $subject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }


    /**
     * Send telegram message
     *
     * @param mixed $notifiable
     * @return TelegramMessage|TelegramFile
     */
    public function toTelegram($notifiable)
    {
        $message = "$this->subject \n\n $this->message";
        return $this->telegramMessage($message);
    }

}
