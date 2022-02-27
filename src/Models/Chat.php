<?php

namespace Osoobe\TelegramBot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Osoobe\LaravelTraits\Support\Active;
use Osoobe\LaravelTraits\Support\TimeDiff;

class Chat extends Model
{
    use Active;
    use HasFactory;
    use TimeDiff;

    protected $fields = [
        'bot_token',
        'chat_id',
        'chat_name',
        'chat_type',
        'is_active',
        'name',
        'privacy',
        'telegramable_id',
        'telegramable_type',
    ];

    protected $table = "telegram_chats";

    /**
     * Get the parent imageable model (user or post).
    */
    public function telegramable()
    {
        return $this->morphTo();
    }


}
