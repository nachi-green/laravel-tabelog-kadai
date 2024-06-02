@extends('layouts.app')
 
@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h2 class="mt-3 mb-3">Mypage</h2>

        @if  (Auth::user()->subscription('default'))
        <div class="container">
            <ul class="list-group list-group-flush">
                <a href="{{ route('mypage.edit') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">会員情報編集</a>
                <a href="{{ route('mypage.edit_password') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">パスワード変更</a>
                <a href="{{ route('stripe.edit') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">クレジットカード情報編集</a>
                <a href="{{ route('mypage.book') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">予約一覧</a>
                <a href="{{ route('mypage.favorite') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">お気に入り一覧</a>
                <a href="{{ route('stripe.cancel_confirm') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">有料会員登録解除</a>
            </ul>
        </div>

        @else
        <div class="container">
            <ul class="list-group list-group-flush list-group-item-action active">
                <a href="{{ route('mypage.edit') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">会員情報編集</a>
                <a href="{{ route('mypage.edit_password') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">パスワード変更</a>
                <a href="{{ route('stripe.subscription') }}" class="text-body list-group-item list-group-item-action fs-5 mb-2">有料会員登録</a>
            </ul>
        </div>

        @endif
    </div>
</div>
@endsection