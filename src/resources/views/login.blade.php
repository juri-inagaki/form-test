@extends('layouts.app') {{-- layouts/app.blade.php を親レイアウトとして使用 --}}

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">Login</h1>

    <div class="card">
      

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit" class="btn">ログイン</button>
        </form>

        <a href="{{ route('register') }}" class="register-link">新規登録はこちら</a>
    </div>
</div>
@endsection