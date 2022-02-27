<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_chats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('chat_id');
            $table->string('bot_token')->nullable();
            $table->enum('chat_type', ['channel', 'group', 'bot', 'personal'])->default('bot');
            $table->enum('privacy', ['public', 'private'])->default('public');
            $table->tinyInteger('is_active')->default(1);
            $table->nullableMorphs('telegramable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_chats');
    }
}
