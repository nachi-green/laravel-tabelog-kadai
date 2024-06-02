@extends('layouts.app')

@section('content')
<div class="container">
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/troppage_1.jpg')}}" class="d-block toppage-img" alt="食事1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/troppage_2.jpg')}}" class="d-block toppage-img" alt="食事2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/troppage_3.jpg')}}" class="d-block toppage-img" alt="食事3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/troppage_4.jpg')}}" class="d-block toppage-img" alt="食事4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/troppage_5.jpg')}}" class="d-block toppage-img" alt="食事5">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<div class="container">
    <div class="d-flex justify-content-center m-3">
        <form method="GET" action="{{ route('shops.index') }}" class="row mx-auto">
            @csrf
            <div class="col-auto mt-2 align-self-end">
                <input class="form-control search-input" placeholder="店舗名" name="shop_keyword" value="">
            </div>
            <div class="col-auto mt-2 align-self-end">
                <select data-mdb-filter="true" class="form-control search-input" name="category_keyword">
                    <option value="" >カテゴリー</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" >{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto mt-2">
                <button type="submit" class="btn"><i class="fas fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="row justify-content-center">
        <h2 class="mt-3 mb-3">New Arrival</h2>
        <div class="container">
        <div class="mt-4">
            <div class="row w-100">
                @foreach($new_shops as $new_shop)
                    <div class="col-4 card" style="border: none;">
                    @foreach ($shops as $shop)
                    @if ($new_shop == $shop)
                        <a href="{{ route('shops.show', $shop) }}">
                            @if ($shop->image !== "")
                                <img src="{{ asset($shop->image) }}" class="card-img-top" style="border-radius: 0;">
                            @else
                                <img src="{{ asset('img/shop_.jpg')}}" class="card-img-top" style="border-radius: 0;">
                            @endif
                        </a>
                        <div class="row card-body">
                            <div class="col-10 card-title">
                                <p class="mt-1">
                                    <span class="fw-medium fs-4">{{ $shop->name }}</span><br>
                                    <label class="fw-lighter fs-6 card-text">&yen;{{ $shop->lower_price }}～{{ $shop->upper_price }} </label>
                                </p>
                            </div>
                        </div>
                    @endif
                    @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection