<!-- Auth認証（ログイン機能） -->
@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8"'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter ホーム画面</title>
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
          フォロワー：{{ $follower_count }}人</a>
        @endisset

      </div> <!-- /user-information -->

      <!-- つぶやき投稿（入力フォーム） -->
      <div class="tweet-input">
        <h3>いまなにしてる？</h3>
        <!-- 入力フォーム -->
        <!-- urlが ‘index’ となっている所にフォームの値を送る -->
        {!! Form::open(['url' => 'create']) !!}
          <div class="form-group">
            {!!  // type属性, name属性, 初期値, [その他の属性]
              Form::input('text', 'newTweet', null,
              ['required',                       // 入力必須
               'class' => 'form-control',        // クラス
               'placeholder' => 'つぶやき内容']) // 初期の補助文字
            !!}
          </div> <!-- /form-group -->

          <!-- 投稿ボタン -->
          <button type="submit" class="btn button">
            つぶやく
          </button>
        {!! Form::close() !!}
      </div> <!-- /tweet-input -->

      <!-- 投稿一覧 -->
      <div class="tweet-table">
        @foreach ($tweet as $tweet)
        <div class="tweet-text">
          <?php // if($tweet->user_id = 1){ ?>
            <!-- つぶやき内容 -->
            <div class="text">
              <!-- ログインしているユーザーのつぶやきを表示 -->
                <p>{{ $tweet->tweet }}</p>
                <p id="created">{{ $tweet->created }}</p>
            </div>
            <!-- 削除ボタン -->
            <a class=" btn-danger delete-button" href="/post/{{$tweet->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')">削除</a>
          <?php // } @endif ?>
        </div> <!-- /tweet-text -->
        @endforeach
      </div> <!-- /tweet-table -->
    </div> <!-- /main -->
  @endsection

    <!-- JavaScript -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
