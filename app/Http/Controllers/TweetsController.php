<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Search;
use App\Tweet;

class TweetsController extends Controller
{
  // auth認証
  public function __construct()
  {
      $this->middleware('auth');
  }

  // ホーム画面の表示
  public function index()
  {
    // ログインユーザー情報
    $user = auth()->user()->name;    // ユーザー名
    $login_id = auth()->user()->id;  // ユーザーID

    // ツイート情報
    $tweet = \DB::table('tweets')
      ->orderBy('id', 'desc')        // 降順に並び替え
      ->where('user_id', $login_id)  // ログインユーザーのつぶやき
      ->get();

    // フォロー情報
    $follow_count = \DB::table('follows')
      ->where('follow_id', $login_id)
      ->get()->count();
    $follower_count = \DB::table('follows')
      ->where('follower_id', $login_id)
      ->get()->count();

    return
    // 表示
    view('tweets.index',
      ['user'=>$user],                      // ユーザー情報
      ['tweet'=>$tweet])                    // ツイート情報
    ->with(['follow_count'=>$follow_count])        // フォロー人数
    ->with(['follower_count'=>$follower_count]);   // フォロワー人数
  }

  // 新規ツイート投稿処理
  public function create(Request $request)
  {
    $login_id = auth()->user()->id;  // ログインユーザーのつぶやき情報を取得
    $post = $request->input('newTweet');
    DB::table('tweets')->insert([
      // ログインしているユーザーID
      'user_id' => $login_id,
      // つぶやき内容
      'tweet' => $post
    ]);
    // リダイレクト（投稿完了したらホーム画面に戻る）
    return redirect('/index');
  }

  // ツイート削除処理
  public function delete($id)
  {
    DB::table('tweets')
        ->where('id', $id)
        ->delete();

    return redirect('/index');
  }

  // フォローしている人のつぶやき画面
  public function indexFollow()
  {
    // ログインユーザー情報
    $user = auth()->user()->name;    // ユーザー名
    $login_id = auth()->user()->id;  // ユーザーID

    // ツイート情報
    $tweet = \DB::table('tweets')
      ->orderBy('id', 'desc')              // 降順に並び替え
      ->where('user_id', '!=', $login_id)  // フォロー中のユーザーのつぶやき
      ->get();

    // フォロー情報
    $follow_count = \DB::table('follows')
      ->where('follow_id', $login_id)
      ->get()->count();
    $follower_count = \DB::table('follows')
      ->where('follower_id', $login_id)
      ->get()->count();

    // ユーザー情報（フォロー中）
    $follow_user = \DB::table('users')->get();

    return

    // 表示
    view('tweets.index-follow',
      ['user'=>$user],             // ユーザー情報
      ['tweet'=>$tweet])           // ツイート情報
    ->with(['follow_count'=>$follow_count])        // フォロー人数
    ->with(['follower_count'=>$follower_count])   // フォロワー人数
    ->with(['follow_user'=>$follow_user], 'name');
  }
}
