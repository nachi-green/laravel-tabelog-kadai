@extends('layouts.app')
 
 @section('content')
 <div class="container d-flex justify-content-center mt-3">
     <div class="w-50">
         <h2 class="mt-3 mb-3">お気に入り一覧</h2>
 
         <hr>
 
         @foreach ($favorites as $fav)
         <div class="card m-1" style="max-width: 540px;" style="border-radius: 0;">
             <div class="row g-0">
                 <div class="col-md-4">
                     <a href="{{ route('shops.show', $fav->favoriteable_id) }}">
                         @if (App\Models\Shop::find($fav->favoriteable_id)->image !== "")
                             <img src="{{ asset(App\Models\Shop::find($fav->favoriteable_id)->image) }}" class="img-fluid rounded-start  p-2" style="border-radius: 0;">
                         @else
                             <img src="{{ asset('img/shop_.jpg')}}" class="img-fluid rounded-start p-2" style="border-radius: 0;">
                         @endif
                     </a>
                 </div>
                 <div class="col-md-8">
                     <div class="card-body p-2">
                         <h5 class="card-title">{{ App\Models\Shop::find($fav->favoriteable_id)->name }}</h5>
                         <a href="{{ route('shops.favorite', $fav->favoriteable_id) }}" class="favorite-item-delete text-secondary card-text">
                            <small class="text-body-secondary"><i class="fa-regular fa-heart"></i> お気に入り登録解除</small>
                         </a>
                     </div>
                 </div>
             </div>
         </div>
         @endforeach
     </div>
 </div>
 @endsection