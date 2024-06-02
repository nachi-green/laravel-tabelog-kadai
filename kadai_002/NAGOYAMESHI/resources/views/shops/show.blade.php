@extends('layouts.app')

@section('content')
@if (session('flash_message'))
<div class="d-flex justify-content-center">
    <div class="alert alert-warning w-75 text-start">
    <i class="fa-solid fa-circle-info"></i> {{ session('flash_message') }}
    </div>
</div>
@elseif ($errors->any())
<div class="d-flex justify-content-center">
    <div class="alert alert-warning w-75 text-start">
        @foreach ($errors->all() as $error)
        <i class="fa-solid fa-circle-info"></i> {{ $error }}<br>
        @endforeach
    </div>
</div>
@endif
<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-sm">
            @if ($shop->image !== "")
                <img src="{{ asset($shop->image) }}" class="w-100 img-fluid">
            @else
                <img src="{{ asset('img/shop_.jpg')}}" class="w-100 img-fluid">
            @endif
        </div>
        <div class="col-sm">
            <div class="d-flex flex-column ms-2">
                <div class="row">
                    <div class="col">
                        <h1 class="">{{ $shop->name }} <span class="review-score-color fw-normal">{{ str_repeat('★', $reviews_round_avgScore) }}</span></h1>
                    </div>
                    <div class="col align-self-center">
                        <span class="fw-normal fs-6 float-end px-1"><i class="fa-regular fa-comment pl-3"></i>：{{ $reviews_count }}件</span>
                        <span class="fw-normal fs-6 float-end px-1"><i class="fa-solid fa-heart"></i>：{{ $favorites_count }}人</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto">
                        @foreach ($categories as $category)
                            @if ($category->id == $shop->category_id)
                            <p class="fw-semibold mb-0">カテゴリー：<span class="fw-normal">{{ $category->name }}</span></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-auto">
                        <p class="fw-semibold mb-0">予算：<span class="fw-normal">&yen;{{ $shop->lower_price }}～{{ $shop->upper_price }}</span></p>
                    </div>
                    <div class="col-auto">
                        <p class="fw-semibold mb-0">営業時間：<span class="fw-normal">{{ substr($shop->start_time, 0, 5) }}～{{ substr($shop->close_time, 0, 5) }}</span></p>
                    </div>
                    <div class="col-auto">
                        <p class="fw-semibold mb-0">定休日：<span class="fw-normal">{{ $shop->regular_holiday }}</span></p>
                    </div>
                </div>
                <hr class="my-3">

                <div class="container ps-0">
                    <p class="">{{ $shop->description }}</p>
                    <hr class="my-2">
                        <p class="shop-description col text-start fs-6 my-1 fw-semibold">住所：<span class="fw-normal">&#12306;{{ $shop->postal_code }} {{ $shop->address }}</span></p>
                        <p class="shop-description col text-start fs-6 my-1 fw-semibold">電話番号：<span class="fw-normal">{{ $shop->phone }}</span></p>
                </div>
                <hr class="mb-3 mt-1">
            </div>
            @auth
            <div class="row">
                <div class="col align-self-center">
                    @if  (Auth::user()->subscription('default'))
                    <div class="text-center ps-0">
                        <a href="{{ route('books.create', $shop->id) }}" class="btn text-dark w-50 fs-5" >
                        <i class="fa-regular fa-calendar-plus"></i>　予約</a>
                    </div>
                    @else
                    <div class="text-center ps-0">
                        <a href="#" class="btn text-dark w-50 fs-5" >
                        <i class="fa-regular fa-calendar-plus"></i>　予約</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-warning w-75 text-start">
                        <i class="fa-solid fa-circle-info"></i> 有料会員のみが予約できます。
                        <a href="{{ route('mypage') }}">{{ __('Mypage') }}より有料会員登録が可能です。</i></a>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col">
                    @if  (Auth::user()->subscription('default'))
                    <form method="POST">
                        @csrf
                        <div class="text-center ps-0">
                            @if($shop->isFavoritedBy(Auth::user()))
                            <a href="{{ route('shops.favorite', $shop) }}" class="btn text-dark fs-5">
                                <i class="fa-solid fa-heart"></i>　お気に入り登録
                            </a>
                            @else
                            <a href="{{ route('shops.favorite', $shop) }}" class="btn text-dark fs-5">
                                <i class="fa-regular fa-heart"></i>　お気に入り解除
                            </a>
                            @endif
                        </div>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="row mt-5 mx-2">
            <h3 class="float-left">User Reviews <i class="fa-regular fa-comment"></i></h3>
            <hr>

            @foreach($reviews as $review)
            <div class="container bg-light text-dark mb-2">
                <div class="row m-3">
                    <div class="col-5 text-start fs-6 ps-0">
                        <p class="mb-1 review-score-color"> {{ str_repeat('★', $review->score) }}</p>
                        <p class="mb-1"> {{ $review->user->name }}</p>
                        <p class="mb-1 col-auto"> {{ $review->updated_at ->format('Y/m/d H:i') }}</p>
                        <a href="{{ route('reviews.edit', ['shop' => $shop->id, 'review'=> $review->id]) }}" class="alert-link login-text mb-1">Edit</a>
                        <form action="{{ route('reviews.destroy', ['shop' => $shop->id, 'review'=> $review->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link login-text p-0 mb-1" onclick="return confirm('削除してもよいですか？');">Delete</button>
                        </form>
                    </div>
                    <div class="col-7 px-0">
                        <h5 class="overflow-content">{{ $review->content }}</h5>
                    </div>
                </div>
            </div>
            <hr>
            @endforeach
            {{ $reviews->links() }}
            <div class="mt-1 mx-1">
                <h3 class="float-left">Post Review <i class="fa-regular fa-pen-to-square"></i></h3>
                <div class="container">
                    @auth
                    <form action="{{ route('reviews.store', $shop->id) }}" method="POST">
                        @csrf
                        @if  (Auth::user()->subscription('default'))
                        <div class="row">
                            <div class="col-md-4 align-self-end" style="higth: 30px">
                                <select name="score" class="form-control review-score-color review-input">
                                    <option value="5" class="review-score-color">★★★★★</option>
                                    <option value="4" class="review-score-color">★★★★</option>
                                    <option value="3" class="review-score-color">★★★</option>
                                    <option value="2" class="review-score-color">★★</option>
                                    <option value="1" class="review-score-color">★</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <textarea  style="higth: 30px" name="content" class="form-control review-input"></textarea>
                                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="mt-3 btn submit-button">投稿</button>
                            </div>
                        </div>
                        @else
                        <div class="d-flex justify-content-center">
                            <div class="alert alert-warning w-75 text-start">
                            <i class="fa-solid fa-circle-info"></i> 有料会員のみがレビュー投稿できます。
                            <a href="{{ route('mypage') }}">{{ __('Mypage') }}より有料会員登録が可能です。</i></a>
                            </div>
                        </div>
                        @endif
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection