@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h3 class="mt-3 mb-3">パスワード変更</h3>
            <hr>

            <form method="post" action="{{route('mypage.update_password')}}">
            @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="password" class="text-md-left edit-user-info-label pb-1">新しいパスワード</label>
                    </div>
                    <div class="collapse show">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="password-confirm" class="text-md-left edit-user-info-label pb-1">確認</label>
                    </div>
                    <div class="collapse show">
                        <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password-confirm" required autocomplete="new-password">
                    </div>
                </div>
                <br>

                <div class="form-group">
                    <button type="submit" class="btn submit-button mt-3 mx-2 w-25">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection