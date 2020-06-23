<!-- Auth認証（ログイン機能） -->
@extends('layouts.app')

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8"'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twitter ユーザー検索画面</title>
</head>
<body>
@section('content')
  <!-- メイン -->
  <div class="main">
    <!-- 検索フォーム -->
      <div class="search-input">
        <form class="form-inline">
        @if($keyword)  <!-- もし検索時に「$keyword」が入力されてる場合 -->
          <!-- 検索結果の表示 -->
          <h3 class="search-h3">検索結果</h3><br>
        @else <!-- もし検索時に「$keyword」が入力されていない場合 -->
          <!-- キーワード入力フォームの表示 -->
          <h3>友達を見つけてフォローしましょう！</h3><br>
          <div class="form-group">
            <input type="text" name="keyword"
                   value="{{ $keyword }}"placeholder="ユーザー名を入力">
            <br><br>
          </div> <!-- /form-group -->
          <input type="submit" value="検索" class="btn button search-btn">
        </form><br><br>
        @endif
      </div> <!-- /tweet-input -->

    <!-- ユーザー名の検索結果 -->
    <div class="search-container">
    @if($keyword)  <!-- もし検索時に「$keyword」が入力されてる場合 -->
      <!-- 表示 -->
      <table class='table table-hover search-table'>
        <!-- カラム -->
        <tr>
          <th>ユーザーID</th>
          <th>ユーザー名</th>
          <th>相手のフォロー状態</th>
          <th>自分のフォロー状態</th>
        </tr>

        <!-- レコード -->
        @foreach ($users as $users)
          <tr>
            <!-- ログインユーザー以外を表示する -->
            @if($users->id !== auth()->user()->id)
              <td>{{ $users->id }}</td>
              <td>{{ $users->name }}</td>
              <td>
                @if(auth()->user()->isFollowed($users->id))
                  <p class='follower_text'>フォローされています</p>
                @endif
              </td>
              <td>
                <!-- フォロー済みだった場合 -->
                @if(auth()->user()->isFollowing($users->id))
                  <!-- フォロー情報のID取得 -->
                  @foreach($follow as $follows)
                    <!-- 選択したユーザーのフォロー解除 -->
                    @if($follows->follower_id == $users->id)
                    <!-- <p>{{$follows->id}}</p> -->
                    <a class="btn button search-btn following"
                       href="/post/{{$follows->id}}/unfollow"
                       onclick="return confirm('こちらのユーザーをフォロー解除しますか？')">フォロー解除</a>
                    @endif
                  @endforeach
                <!-- フォローしてない場合 -->
                @else
                  {!! Form::open(['url' => 'follow']) !!}
                  {{ csrf_field() }}
                  <button type="submit" class="btn button search-btn" name="newFollow" value="{{ $users->id }}">
                    フォローする
                  </button>
                     <!-- type属性, name属性, 初期値, [その他の属性]
                      Form::input('submit', 'newFollow', $users->id,
                      ['class' => 'btn button search-btn',        // クラス
                      'value' => 'フォロー']) // 初期の補助文字 -->
                  {!! Form::close() !!}
                @endif
              </td>
            @endif
          </tr>
        @endforeach  <!-- /$users -->
      </table>

    @else
      <!-- 表示なし -->
    @endif

    <!-- 戻るボタン -->
    @if($keyword)  <!-- もし検索時に「$keyword」が入力されてる場合 -->
      <!-- 表示 -->
      <a class="btn back-btn" href="/search">戻る</a>
    @else <!-- もし検索時に「$keyword」が入力されていない場合 -->
      <!-- 表示しない -->
    @endif
    </div>

  </div> <!-- /main -->
@endsection

  <!-- JavaScript -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
