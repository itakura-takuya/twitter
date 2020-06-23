<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
// ホーム画面
Route::get('/index', 'TweetsController@index');
Route::get('/index/{name}', function($name){
  return 'User' .$name;
});

// ログイン画面、新規登録画面
Auth::routes();
// 新規登録完了
Route::get('/home', 'HomeController@index')->name('home');
// ツイート投稿
Route::post('/create', 'TweetsController@create');
// ツイート削除
Route::get('/post/{id}/delete', 'TweetsController@delete');
// フォローしている人のつぶやき
Route::get('/index-follow', 'TweetsController@indexFollow');
// ユーザー検索画面
Route::get('search', 'SearchController@index')->name('search.index');
// フォローする
Route::post('/follow', 'SearchController@follow', function(Request $request){

})->name('follow');
// フォロー解除
Route::get('/post/{id}/unfollow', 'SearchController@unfollow');
Route::delete('search?keyword=/unfollow', 'SearchController@unfollow')
       ->name('unfollow');
