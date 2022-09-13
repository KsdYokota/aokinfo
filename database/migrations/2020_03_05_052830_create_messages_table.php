<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('type');
            $table->text('description');
            $table->timestamps();

            
            $table->unsignedBigInteger('item_id');

            $table->foreign('item_id')
                  ->references('id')
                  ->on('items')
                  ->onDelete('cascade'); // itemsが削除されたとき、それに関連するmessageも一気に削除される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
