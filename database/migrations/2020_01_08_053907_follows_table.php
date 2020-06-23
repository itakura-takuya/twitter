<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //全ユーザーのフォロー関係を管理
      Schema::create('follows', function (Blueprint $table) {
          $table->integer('id');           // 各行のID
          $table->integer('follow_id');    // フォローユーザーID
          $table->integer('follower_id');  // フォロワーユーザーID
          // ツイートした日時
          $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
          // ツイートの更新日時
          $table->timestamp('modified')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

          // 複合主キーの設定
          $table->primary(['id','follow_id','follower_id']);
            // 各行のID, フォローユーザーID, フォロワーユーザーID
      });

      Schema::table('follows', function (Blueprint $table) {
          // インクレメント（増加・増分）の設定
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
      Schema::drop('follows');
    }
}
