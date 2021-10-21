@extends('layouts.main')
@section('title', '詳細画面')
@section('content')
@include('partial.flash')
@include('partial.errors')
<section>
    <article class="card shadow position-relative">
        <figure class="m-3">
            <div class="row">
                <div class="col-6">
                    @foreach ($item->image_urls as $url)
                        <img src="{{ $url }}" width="100%">
                    @endforeach
                </div>
                <div class="col-6">
                    <figcaption>
                        <p class="h2">
                            商品名：{{ $item->title }}
                        </p>
                        <p class="h2">
                            値段：{{ $item->price }}円
                        </p>
                        <p class="h4">
                            商品説明：{{ $item->body }}
                        </p>
                    </figcaption>
                </div>
            </div>
        </figure>
        @can('update', $item)
        <a href="{{ route('items.edit', $item) }}">
            <i class="fas fa-edit position-absolute top-0 end-0 fs-1"></i>
        </a>
        @endcan
    </article>
</section>
@can('delete', $item)
<form action="{{ route('items.destroy', $item) }}" method="post" id="form">
    @csrf
    @method('delete')
</form>
<div class="d-grid col-6 mx-auto gap-3">
    <input type="submit" value="削除" form="form" class="btn btn-danger btn-lg"
        onclick="if (!confirm('本当に削除してよろしいですか？')) {return false};">
    @endcan
</div>
<div class="d-grid col-6 mx-auto gap-3">
    <a href="{{ route('items.index') }}" class="btn btn-secondary btn-lg">戻る</a>
</div>
@endsection
