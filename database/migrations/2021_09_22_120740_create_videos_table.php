<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('admin_id');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->integer('category_id')->unsigned();
            $table->string('poster');
            $table->string('video_file');
            $table->string('video_public_id');
            $table->string('poster_public_id');
            $table->tinyInteger('is_paid')->default(1);
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
        Schema::dropIfExists('videos');
    }
}
