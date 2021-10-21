@extends('layouts.main')
@section('title', '一覧画面')
@section('content')
@include('partial.flash')
@include('partial.errors')
<section class="row position-relative" data-masonry='{ "percentPosition": true }'>
    @foreach ($items as $item)
    <div class="col-6 col-md-4 col-lg-3 col-sl-2 mb-4">
        <article class="card position-relative">
            <a href="{{ route('items.show', $item) }}" class="text-decoration-none stretched-link">
                <img src="{{ $item->image_urls[0] }}" alt="image" class="card-img-top">
            </a>
            <div class="card-title mx-3">
                <p>値段：{{ $item->price }}円</p>
            </div>
        </article>
    </div>
    @endforeach
</section>
<a href="{{ route('items.create') }}" class="position-fixed fs-1 bottom-right-50 zindex-sticky">
    <i class="fas fa-plus-circle"></i>
</a>
@endsection
