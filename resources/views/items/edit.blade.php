@extends('layouts.main')
@section('title', '編集画面')
@section('content')
@if ($errors->any())
<div class="error">
    <p>
        <b>{{ count($errors) }}件のエラーがあります。</b>
    </p>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section>
    <article class="card shadow">
        <figure class="m-3">
            <div class="row">
                <div class="col-6">
                    @foreach ($item->image_urls as $url)
                    <img src="{{ $url }}" width="100%">
                    @endforeach
                </div>
                <div class="col-6">
                    <figcaption>
                        <form action="{{ route('items.update', $item) }}" method="post" id="form">
                            @csrf
                            @method('patch')
                            <div class="mb-3">
                                <label for="title" class="form-label">商品名を入力してください</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title', $item->title) }}">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">商品の値段（数字のみ）を入力してください</label>
                                <div class="d-flex flex-row">
                                    <div class="mr-2 col-11"><input type="number" name="price" id="price"
                                            class="form-control" min='0' value="{{ old('price', $item->price) }}"></div>
                                    <div class="col-1 h1">円</div>
                                </div>
                            </div>
                            <div>
                                <label for="body" class="form-label">商品詳細を入力してください</label>
                                <textarea name="body" id="body" rows="5"
                                    class="form-control">{{ old('body', $item->body) }}</textarea>
                            </div>
                        </form>
                    </figcaption>
                </div>
            </div>
        </figure>
    </article>
    <div class="d-grid gap-3 col-6 mx-auto">
        <input type="submit" value="更新" form="form" class="btn btn-success btn-lg">
        <a href="{{ route('items.index') }}" class="btn btn-secondary btn-lg">戻る</a>
    </div>
</section>
@endsection
