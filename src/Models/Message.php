<?php

namespace Osoobe\TelegramBot\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Osoobe\Utilities\Traits\TimeDiff;

class Message extends Model
{
    use HasFactory;
    use TimeDiff;

    protected $table = "telegram_messages";


    protected $fillable = [
        'name',
        'model_type',
        'model_id',
        'chat_id',
        'message_id',
        'content',
        'data',
        'is_active',
        'success'
    ];

    protected $casts = [
        'data' => 'array'
    ];

}
