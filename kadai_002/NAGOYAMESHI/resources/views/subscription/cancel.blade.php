@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h2 class="mt-3 mb-3">有料会員登録解除</h2>
        <hr>
        @auth
            <div class="row">
                <h4>登録解除しますか？</h4>
                <p><i class="fa-solid fa-circle-info"></i> お気に入り登録機能や店舗来店予約ができなくなります。</p>
                <form action="{{ route('stripe.cancel') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <button type="submit" class="mt-3 btn btn-warning">登録解除</button>
                    </div>
                </form>
            </div>
        @endauth
        </div>
    </div>
</div>
@endsection
