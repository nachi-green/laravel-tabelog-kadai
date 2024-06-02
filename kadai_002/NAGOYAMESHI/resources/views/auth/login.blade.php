@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mt-3 mb-3">ログイン</h3>
            <h5>会員ページへようこそ！</h5>
            <div class="alert alert-warning">ログインID（メールアドレス）とパスワードを入力してください。
            <br><a class="alert-link login-text" href="{{ route('register') }}">新規登録はこちらから</a>
            <br><a class="alert-link login-text" href="{{ route('password.request') }}">パスワードを忘れた方はこちら</a>
            </div>

            <hr class="hr-color">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row mb-2">
                    <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror login-input " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>メールアドレスが正しくない可能性があります。</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group row mb-2">
                    <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror login-input" name="password" required autocomplete="current-password">
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>パスワードが正しくない可能性があります。</strong>
                    </span>
                    @enderror
                </div>

                <div class="row mb-0">
                    <div class="form-check col-md-4 offset-md-4">
                        <input class="form-check-input mx-1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label check-label" for="remember">次回から自動的にログイン</label>
                    </div>

                    <div class="form-group col-md-6 offset-md-4">
                        <button type="submit" class="mt-3 btn btn-warning">ログイン</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection