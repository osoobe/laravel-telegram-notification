<?php

namespace Osoobe\TelegramBot\Traits;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramMessage;

trait TelegramNotificationTrait {

    private $telegram_bot_token;
    private $telegram_chat_id;

    public function setupTelegram($chat_id="", $bot_token="") {
        $this->telegram_chat_id = $chat_id;
        $this->telegram_bot_token = ( !empty($bot_token))? $bot_token : config('services.telegram.bot_token', $bot_token);
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param  mixed  $notifiable
     * @param  string  $channel
     * @return bool
     */
    public function shouldSend($notifiable, $channel)
    {
        if ( ! $this->shouldTelegram($notifiable, $channel) ) {
            return false;
        }
        return true;
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param  mixed  $notifiable
     * @param  string  $channel
     * @return bool
     */
    public function shouldTelegram($notifiable, $channel)
    {
        if ( in_array($channel, ['telegram', TelegramChannel::class]) ) {
            if ( ! config('services.telegram.enabled', true) || empty($this->telegram_chat_id) || empty($this->telegram_bot_token) ) {
                return false;
            }
        }
        return true;
    }

    /**
     * Send Telegram Message with attachement
     *
     * @param string $url
     * @param string $message
     * @return TelegramFile
     */
    public function telegramPhoto($url, $message, $photo) {
        return TelegramFile::create()
            ->token($this->telegram_bot_token)
            ->to($this->telegram_chat_id)
            ->content($message)
            ->file($photo, 'photo');
    }

    /**
     * Send Telegram Message without attachment
     *
     * @param string $url
     * @param string $message
     * @return TelegramMessage
     */
    public function telegramMessage($message) {
        return TelegramMessage::create()
            ->token($this->telegram_bot_token)
            ->to($this->telegram_chat_id)
            ->content($message);;
    }


    /**
     * Get the model that the notification was performed on
     *
     * @return mixed
     */
    public function getPerformedOn() {
        return null;
    }


}

?>
