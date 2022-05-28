<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id_creater');
            $table->unsignedBigInteger('user_id_updater');
            $table->string('shop_name');
            $table->string('shop_name_kana');
            $table->string('branch');
            $table->integer('postcode');
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('address4');
            $table->decimal('map_lat', $precision = 10, $scale = 6);
            $table->decimal('map_long', $precision = 9, $scale = 6);
            $table->string('phone_number1');
            $table->string('phone_number2');
            $table->string('opening_hour1');
            $table->string('opening_hour2');
            $table->string('holiday');
            $table->string('seats');
            $table->string('access');
            $table->string('parking');
            $table->string('official_site');
            $table->string('official_blog');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('shop_type');
            $table->string('opening_date');
            $table->text('menu');
            $table->text('notes');
            // $table->string('tags');
            $table->string('image_path')->nullable();
            $table->text('other');
            $table->timestamps();
            $table->softDeletes();
            // 外部キーを設定
            // $table->foreignId('user_id')->constrained('users');
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
        Schema::dropIfExists('shops');
    }
}
