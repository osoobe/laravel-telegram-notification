<?php

namespace Osoobe\TelegramBot\Traits;

use Osoobe\TelegramBot\Models\Chat;

trait HasChat {

    /**
     * Get telegram chats
     */
    public function telegramChats()
    {
        return $this->morphMany(Chat::class, 'telegramable');
    }

}


?>