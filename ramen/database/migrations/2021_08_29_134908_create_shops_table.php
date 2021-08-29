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
            $table->integer('user_id');
            $table->string('shop_name');
            $table->string('shop_name_kana');
            $table->string('branch')->nullable();
            $table->string('address1');
            $table->string('address2');
            $table->string('address3');
            $table->string('address4');
            $table->decimal('map_lat', 10, 6);
            $table->decimal('map_long', 9, 6);
            $table->string('phone_number1');
            $table->string('phone_number2')->nullable();
            $table->string('opening_hour1');
            $table->string('opening_hour2')->nullable();
            $table->string('holiday');
            $table->string('seats');
            $table->string('access');
            $table->string('parking');
            $table->string('official_site')->nullable();
            $table->string('official_blog')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('shop_type');
            $table->string('opening_date');
            $table->string('menu');
            $table->string('notes');
            $table->string('tags');
            $table->string('other')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->timestamp('deleted_at')->default("9999-12-31 00:00:00");
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
