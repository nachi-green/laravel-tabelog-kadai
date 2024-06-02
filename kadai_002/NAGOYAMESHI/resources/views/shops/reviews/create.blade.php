@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3 class="mt-3 mb-3">レビュー投稿</h3>
        <div class="mt-4">
        @auth
            <div class="row">
                <form action="{{ route('reviews.store', $shop_id) }}" method="POST">
                    @csrf
                    @error('content')
                        <strong>レビューを入力してください</strong>
                    @enderror
                    <select name="score" class="form-control m-2 review-score-color">
                        <option value="5" class="review-score-color">★★★★★</option>
                        <option value="4" class="review-score-color">★★★★</option>
                        <option value="3" class="review-score-color">★★★</option>
                        <option value="2" class="review-score-color">★★</option>
                        <option value="1" class="review-score-color">★</option>
                    </select>
                    <div class="form-group mb-2 row col-md-6">
                        <textarea style="height:75px" name="description" id="shop_name" class="form-control col-md-1 col-form-label"></textarea>
                        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                    </div>
                    <div class="form-group col-md-2 offset-md-1">
                        <button type="submit" class="mt-3 btn btn-warning">投稿</button>
                    </div>
                </form>
            </div>
        </div>
        @endauth
    </div>
</div>
@endsection
