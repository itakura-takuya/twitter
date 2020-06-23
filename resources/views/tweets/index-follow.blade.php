<!-- Auth認証（ログイン機能） -->
@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8"'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter フォローしている人のつぶやき画面</title>
</head>
<body>
  @section('content')
    <!-- メイン -->
    <div class='main'>
      <!-- ユーザー情報 -->
      <div class="user-information">
        <!-- ユーザー名 -->
        <p>{{ $user }}さん</p>

        <!-- フォロー情報 -->
        @isset($follow_count)
        <a class="f-button" href="/index-follow">
          フォロー：{{ $follow_count }}人</a>
        @endisset
        @isset($follower_count)
        <a class="f-button" href="#">
          フォロワー：{{ $follower_count}}人</a>
        @endisset
      </div> <!-- /user-information -->

      <!-- フォロー人数 -->
      <div class="tweet-input">
        @isset($follow_count)
        <h3>{{ $user }}さんは{{ $follow_count }}人フォローしています</h3>
        @endisset
      </div> <!-- /tweet-input -->

      <!-- 投稿一覧 -->
      <div class="tweet-table">
        @foreach ($tweet as $tweet)
          <!-- フォローしているユーザーのつぶやきを表示 -->
          @if(auth()->user()->isFollowing($tweet->user_id))
            <div class="tweet-text">
              <!-- つぶやき内容 -->
              <div class="text">
                  <!-- フォロー中のユーザー名の表示 -->
                  @foreach($follow_user as $follow_users)
                    @if($follow_users->id === $tweet->user_id )
                      <p>{{ $follow_users->name }}</p>
                    @endif
                  @endforeach
                  <p>{{ $tweet->tweet }}</p>
                  <p id="created">{{ $tweet->created }}</p>
              </div>
            </div> <!-- /tweet-text -->
          @endif
        @endforeach <!-- /tweet -->
      </div> <!-- /tweet-table -->
    </div> <!-- /main -->
  @endsection

    <!-- JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
