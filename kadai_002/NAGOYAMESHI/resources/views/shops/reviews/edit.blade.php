@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 class="mt-3 mb-3">レビュー編集</h3>
        <div class="mt-1 mb-3">
            <a href="{{ route('shops.show', $shop->id) }}" class="alert-link login-text"> Back</a>
        </div>
        @auth
            <div class="container">
                <form action="{{ route('reviews.update', ['shop' => $shop->id, 'review'=> $review->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <h3 class="mt-2 mb-2 col-sm-3">評価</h3>
                    <div class="form-group mb-2 col-sm-2">
                        <select name="score" class="form-select review-score-color review-input mb-5 col-auto">
                            <option value="{{ $review->score }}" class="review-score-color" selected>{{ str_repeat('★', $review->score) }}</option>
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>
                    </div>
                    <h3 class="mt-2 mb-2 col-sm-3">コメント</h3>
                    <div class="form-group mb-2">
                        <textarea style="height:100px" class="review-input col-sm-8" name="content" value="{{ $review->content }}">{{ $review->content }}</textarea>
                        <input type="hidden" name="shop_id" value="{{ $review->shop_id }}">
                    </div>

                    <div class="form-group mt-2 mb-2 col-sm-3">
                        <button type="submit" class="mt-3 btn btn-warning">編集</button>
                    </div>
                </form>
            </div>
        @endauth
    </div>
</div>
@endsection