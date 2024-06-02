@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col">
                <h2 class="mt-3 mb-3">検索結果</h2>
            </div>
            <div class="col text-end">
                <p class="mt-3 mb-3 text-secondary">{{ $shop_count }}/{{ $total_shop_count }} 件</p>
            </div>
        </div>
                
        <div class="container">
            <div>
                <p class="mt-3 mb-3 text-secondary">
                    Sort By：
                    @sortablelink('lower_price', '予算')
                </p>
            </div>
            <div class="mt-4">
                <div class="row w-100">
                    @foreach($shops as $shop)
                    <div class="col-4 card" style="border: none;">
                        <a href="{{ route('shops.show', $shop) }}">
                            @if ($shop->image !== "")
                            <img src="{{ asset($shop->image) }}" class="card-img-top" style="border-radius: 0;">
                            @else
                            <img src="{{ asset('img/shop_.jpg')}}" class="card-img-top" style="border-radius: 0;">
                            @endif
                        </a>
                        <div class="row card-body">
                            <div class="col-sm-10 card-title">
                                <p class="mt-1">
                                    <span class="fw-medium fs-4">{{ $shop->name }}</span><br>
                                    <label class="fw-lighter fs-6 card-text">&yen;{{ $shop->lower_price }}～{{ $shop->upper_price }} </label>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{ $shops->appends(request()->query())->links() }}
    </div>
</div>
@endsection