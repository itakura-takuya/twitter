@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- <div class="col-md-8"> -->
            <div class="main">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- You are logged in! -->
                    <h3>登録完了しました。</h3>
                    <p>{{ $user }}さんはツイッターに参加されました。</p>
                    <p>ログインをクリックしてつぶやいてください。</p>

                    <!-- <a class="btn button" href="/index">ログインへ</a> -->
                    <div class="login-btn">
                      <a  href="/index">ログインへ</a>
                    </div>

                </div>
            </div>
        <!-- </div> -->
    </div>
</div>
@endsection
