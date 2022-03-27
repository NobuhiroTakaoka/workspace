<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prefecture_id');
            $table->string('city_code')->comment('市区町村コード');
            $table->string('city_name')->comment('市区町村名');
            $table->timestamps();

            // インデックスを作成
            $table->index('prefecture_id');
            $table->index('city_name');

            // 外部キーを設定
            $table->foreign('prefecture_id')->references('id')->on('prefectures')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
