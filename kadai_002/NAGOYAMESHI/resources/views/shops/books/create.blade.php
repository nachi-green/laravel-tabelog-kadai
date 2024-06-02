@extends('layouts.app')

@section('content')
@if (session('error'))
<div class="d-flex justify-content-center">
    <div class="alert alert-warning w-75 text-start">
        <i class="fa-solid fa-circle-info"></i> {{ session('error') }}
    </div>
</div>
@endif

<div class="container d-flex justify-content-center mt-3">
    <div class="w-50">
        <h2 class="mt-3 mb-3">予約</h2>
        <div class="mt-4">
        @auth
            <div class="row">
                <form action="{{ route('books.store', $shop->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="book_date" class="text-md-left edit-user-info-label pb-1">予約日</label>
                        </div>
                        <div class="collapse show">
                            <select class="mx-2 mb-0 form-control @error('book_date') is-invalid @enderror" name="book_date" id="book_date" required>
                                <option value="">選択してください</option>
                                @for($i = 0; $i<=29; $i++)
                                    <option value="{{ \Carbon\Carbon::now()->addDay($i)->format('Y-m-d') }}">{{ \Carbon\Carbon::now()->addDay($i)->format('Y/m/d') }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="book_time" class="text-md-left edit-user-info-label pb-1">予約時間</label>
                        </div>
                        <div class="collapse show">
                            <select class="mx-2 mb-0 form-control @error('book_time') is-invalid @enderror" name="book_time" id="book_time" required>
                                <option value="">選択してください</option>
                                @for($i = 0; $i<=11; $i++)
                                    <option value="{{ \Carbon\Carbon::createFromTimeString($shop->start_time)->addHours($i)->format('H:i:m') }}">{{ \Carbon\Carbon::createFromDate($shop->start_time)->addHours($i)->format('H:i') }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <br>

                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="book_number" class="text-md-left edit-user-info-label pb-1">予約人数</label>
                        </div>
                        <div class="collapse show">
                            <select class="mx-2 mb-0 form-control @error('book_number') is-invalid @enderror" name="book_number" id="book_number" required>
                                <option value="">選択してください</option>
                                @for($i = 1; $i<=30; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn submit-button mt-3 mx-2 w-25">確定</button>
                    </div>
                </form>
            </div>
        @endauth
        </div>
    </div>
</div>
@endsection