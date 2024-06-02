@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mt-3 mb-3 fw-bold">新規会員登録</h3>
            <div class="alert alert-warning">会員登録の仮登録を行います。<br>会員登録をするメールアドレスを入力し、送信ボタンをクリックしてください。<br>
            入力したメールアドレス宛に本登録を行うURLを送信致しますので、URLへアクセスをし、本登録を行ってください。
            </div>

            <hr>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group row mb-2">
                        <label for="name" class="col-md-4 col-form-label text-md-end">氏名<span class="mx-1 require-input-label-text">必須</span></label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス<span class="mx-1 require-input-label-text">必須</span></label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="password" class="col-md-4 col-form-label text-md-end">パスワード<span class="mx-1 require-input-label-text">必須</span></label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>8文字以上で指定してください。</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-2">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">パスワード再入力<span class="mx-1 require-input-label-text">必須</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="form-group col-md-6 offset-md-4">
                            <button type="submit" class="mt-3 btn btn-warning">登録</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection