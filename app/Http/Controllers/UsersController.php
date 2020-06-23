<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Tweet;
// use App\Models\Follower;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ログインしているユーザIDを引数で渡す
    public function index(User $user)
    {
        $all_users = $user->getAllUsers(auth()->user()->id);

        return view('users.index', [
            'all_users'  => $all_users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Tweet $tweet, Follower $follower)
    {
      // 自身の情報
      $login_user = auth()->user();
      $is_following = $login_user->isFollowing($user->id);
      $is_followed = $login_user->isFollowed($user->id);
      // ユーザーのツイート情報
      $timelines = $tweet->getUserTimeLine($user->id);
      // カウント関連
      $tweet_count = $tweet->getTweetCount($user->id);
      $follow_count = $follower->getFollowCount($user->id);
      $follower_count = $follower->getFollowerCount($user->id);

      return view('users.show', [
          'user'           => $user,
          'is_following'   => $is_following,
          'is_followed'    => $is_followed,
          'timelines'      => $timelines,
          'tweet_count'    => $tweet_count,
          'follow_count'   => $follow_count,
          'follower_count' => $follower_count
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
