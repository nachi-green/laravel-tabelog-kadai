@extends('layouts.app')
 
@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h2 class="mt-3 mb-3">予約一覧</h2>

        <hr>

        @foreach ($books as $book)
        <div class="card m-1" style="max-width: 540px;" style="border-radius: 0;">
            <div class="row g-0">
                <div class="col-md-4">
                    <a href="{{route('shops.show', $book->shop_id)}}">
                        @if (App\Models\Shop::find($book->shop_id)->image !== "")
                            <img src="{{ asset(App\Models\Shop::find($book->shop_id)->image) }}" class="img-fluid rounded-start  p-2" style="border-radius: 0;">
                        @else
                            <img src="{{ asset('img/shop_.jpg')}}" class="img-fluid rounded-start p-2" style="border-radius: 0;">
                        @endif
                    </a>
                </div>
                <div class="col-md-8">
                    <div class="card-body p-2">
                        <h5 class="card-title">{{ App\Models\Shop::find($book->shop_id)->name }}</h5>
                        <p class="card-text mb-1">予約日時：<span>{{ $book->book_date }} {{ substr($book->book_time, 0, 5) }}</span></p>
                        <p class="card-text mb-1">予約人数：<span>{{ $book->book_number }}人</span></p>
                        <form action="{{ route('books.cancel', ['shop' => $book->shop_id, 'book'=> $book->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="card-text btn btn-link login-text p-0 mb-1" onclick="return confirm('予約取り消ししてもよいですか？');"><small class="text-body-secondary">予約取り消し</small></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection