@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="mt-3 mb-3">会員情報の編集</h3>
            <hr>

            <form method="POST" action="{{ route('mypage') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name" class="text-md-left edit-user-info-label pb-1">氏名</label>
                    </div>
                    <div class="collapse show">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="email" class="text-md-left edit-user-info-label pb-1">メールアドレス</label>
                    </div>
                    <div class="collapse show">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn submit-button mt-3 mx-2 w-25">保存</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection