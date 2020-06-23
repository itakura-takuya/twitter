<?php

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TweetsTable extends Migration
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Schema::defaultStringLength(191);
  }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      // 全ユーザーのツイート管理
      Schema::create('tweets', function (Blueprint $table) {
          $table->integer('id');          // 各行のID
          $table->integer('user_id');     // ユーザーID
          $table->string('tweet', 255);   // ツイート内容
          // ツイートした日時
          $table->timestamp('created')->default(DB::raw('CURRENT_TIMESTAMP'));
          // ツイートの更新日時
          $table->timestamp('modified')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

          // 複合主キーの設定
          $table->primary(['id','user_id']);   // 各行のID, ユーザーID
      });

      Schema::table('tweets', function (Blueprint $table) {
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
      Schema::drop('tweets');
    }

}
