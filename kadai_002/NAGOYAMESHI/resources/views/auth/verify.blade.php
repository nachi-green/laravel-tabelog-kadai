@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mt-3 mb-3">仮会員登録完了</h3>
            <h5 class="text-center">会員登録ありがとうございます。</h5>

            <hr>

            <p class="text-center">現在、仮会員の状態です。</p>
            <p class="text-center">ご入力いただいたメールアドレス宛に、ご本人様確認用のメールをお送りしました。  </p>
            <p class="text-center">メール本文内のURLをクリックすると本会員登録が完了となります。</p>
            <div class="text-center">
                <a href="{{ url('/') }}" class="mt-3 btn btn-warning">トップページ</a>
            </div>
        </div>
    </div>
</div>
@endsection
