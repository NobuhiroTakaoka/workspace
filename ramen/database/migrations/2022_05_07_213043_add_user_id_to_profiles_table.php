<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            // 既存の外部キー制約を削除（idから削除）
            // $table->dropForeign('profiles_id_foreign');
            // 外部キーを設定（user_idに設定）
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
        Schema::table('profiles', function (Blueprint $table) {
            // 外部キー制約を削除（user_idから削除）
            // $table->dropForeign('profiles_user_id_foreign');
            //カラムの削除（user_idを削除）
            $table->dropColumn('user_id');
            // 外部キーを設定（idに設定）
            $table->foreign('id')->references('id')->on('users')->onUpdate('CASCADE');
        });
    }
}
