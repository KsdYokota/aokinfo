<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\PublishType;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            // $table->id();
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('title');
            $table->timestamps();
            $table->enum('publish_type', PublishType::getValues())
                ->default(PublishType::DRAFT);

            $table->date('published_at')
                ->default(\Carbon\Carbon::now());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}