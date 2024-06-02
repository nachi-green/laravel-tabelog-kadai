@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="row w-50">
        <h2 class="mt-3 mb-3">会社情報</h2>
        @foreach($companyinfo as $info)
        <div class="row">
            <div class="col-4">
                <h3 class="fw-semibold mb-0">会社名<span class="fw-normal"></h3>
            </div>
            <div class="col-6">
                <h5 class="fw-normal mb-0">{{ $info->name }}</h5>
            </div>
        </div>
        <hr class="mb-3 mt-1">

        <div class="row">
            <div class="col-4">
                <h3 class="fw-semibold mb-0">設立日<span class="fw-normal"></h3>
            </div>
            <div class="col-6">
                <h5 class="fw-normal mb-0">{{ $info->date_of_incorporation }}</h5>
            </div>
        </div>
        <hr class="mb-3 mt-1">

        <div class="row">
            <div class="col-4">
                <h3 class="fw-semibold mb-0">住所<span class="fw-normal"></h3>
            </div>
            <div class="col-6">
                <h5 class="fw-normal mb-0">&#12306;{{ $info->postal_code }} {{ $info->address }}</h5>
            </div>
        </div>
        <hr class="mb-3 mt-1">

        <div class="row">
            <div class="col-4">
                <h3 class="fw-semibold mb-0">電話番号<span class="fw-normal"></h3>
            </div>
            <div class="col-6">
                <h5 class="fw-normal mb-0">{{ $info->phone }}</h5>
            </div>
        </div>
        <hr class="mb-3 mt-1">
        @endforeach
    </div>
</div>
@endsection