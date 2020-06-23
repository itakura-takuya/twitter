<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
        $table->integer('id');                 // 各行のID
        $table->string('name');                // ユーザー名
        $table->string('email')->unique();     // メールアドレス
        $table->string('password');            // パスワード
        //アカウント作成日
        $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
        // アカウント更新日
        $table->timestamp('modified')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

        // 主キーの設定
        $table->primary(['id']);   // 各行のID
      });

      Schema::table('users', function (Blueprint $table) {
          // 主キーの設定
          $table->increments('id')->change();   // 各行のID
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      //テーブルの削除
      Schema::dropIfExists('users');
    }
}
