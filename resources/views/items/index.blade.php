@extends('layouts.main')
@section('title', '一覧画面')
@section('content')
    <h1>商品一覧</h1>
    <section class="row" 　data-masonry='{ "percentPosition": true }'>
        @foreach ($items as $item)
            <div class="col-6 col-md-4 col-lg-3 col-sl-2 mb-4">
                <article class="card position-relative">
                    <a href="{{ route('items.show', $item) }}" class="text-decoration-none stretched-link">
                        <img src="{{ $item->image_url }}" class="card-img-top">
                    </a>
                    <div class="card-title mx-3">
                        <p>値段：{{ $item->price }}円</p>
                    </div>
                </article>
            </div>
        @endforeach
    </section>
    <a href="{{ route('items.create') }}" class="position-fixed fs-1 bottom-0 end-0">
        <i class="fas fa-plus-circle"></i>
    </a>
@endsection
