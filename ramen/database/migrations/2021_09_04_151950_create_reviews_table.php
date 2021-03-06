<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->unsignedBigInteger('user_id');
            $table->string('menu_title');
            $table->string('category');
            $table->string('soup');
            $table->integer('points');
            $table->string('image_path');
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes();
            // 外部キーを設定
            // $table->foreign('shop_id')->references('id')->on('shops')->onUpdate('CASCADE');
            // $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
