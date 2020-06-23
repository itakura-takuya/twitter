<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //付け加える
use App\User;
use App\Search;

class SearchController extends Controller
{
    // auth認証
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ユーザー検索画面
    public function index(Request $request)
    {
        //キーワードを取得
        $keyword = $request->input('keyword');
        // ログインしているユーザーIDの取得
        $login_id = auth()->user()->id;
        // フォロー情報の取得
        $follow = \DB::table('follows')
                 ->where('follow_id', $login_id)
                 ->get();
        $followers = \DB::table('follows')
                  // ->where('follower_id', '<>', $login_id)
                  ->get();

        //もしキーワードが入力されている場合
        if(!empty($keyword))
        {
            //ユーザー名から検索
            $users = \DB::table('users')
                    ->where('name', 'like', '%'.$keyword.'%')
                    ->get();

        }else{//キーワードが入力されていない場合
            $users = DB::table('users')->get();
        }

        return
        //検索フォームへ
        view('search.index',
            ['users'  =>$users,
             'keyword'=>$keyword],
            ['follow'=>$follow])
        ->with(['follow'=>$follow], 'id')
        ->with(['followers'=>$followers]);
    }

    /***************************************
     * フォロー機能
     **************************************/
    // フォローする
    // public function follow(User $users)
    // {
    //     $follower = auth()->user();
    //     // フォローしているか
    //     $is_following = $follower->isFollowing($users->id);
    //     if(!$is_following) {
    //         // フォローしていなければフォローする
    //         $follower->follow($users->id);
    //         return back();
    //     }
    // }

    public function follow(Request $request)
    {
      // ログインユーザーのフォロー情報を取得
      $login_id = auth()->user()->id;
      // $post = $request->input('newFollow');
      // $user_id = $request->input('newFollow');
      $user_id = $request->newFollow;
      // リクエストメソッドの取得
      $request->method();
      // フォローする
      DB::table('follows')->insert([
          'follow_id'   => $login_id,  // フォローした人
          'follower_id' => $user_id       // フォローされた人
      ]);
      // リダイレクト（フォローしたら検索画面に戻る）
      return redirect('/search');
    }

    /***************************************
     * フォロー解除機能
     **************************************/
    // フォロー解除する
    public function unfollow($id)
    {
      DB::table('follows')
          ->where('id', $id)
          ->delete();

      return redirect('/search');
    }
    // public function unfollow(User $users)
    // {
    //   $follower = auth()->user();
    //   // フォローしているか
    //   $is_following = $follower->isFollowing($users->id);
    //   if($is_following) {
    //       // フォローしていればフォローを解除する
    //       $follower->unfollow($users->id);
    //       return back();
    //   }
    // }
}
