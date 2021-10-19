@extends('layouts.main')
@section('title', '詳細画面')
@section('content')
    <h1>画像詳細</h1>
    <section>
        <article class="card shadow">
            <figure class="m-3">
                <div class="row">
                    <div class="col-6">
                        <img src="{{ $item->image_url }}" width="100%">
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
        </article>
    </section>
@endsection
