@extends('layouts.main')
@section('title', '新規登録')
@section('content')
    <div class="col-8 col-offset-2 mx-auto">
        <h1>新規登録</h1>
        <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
            <div class="card mb-3">
                @csrf
                <div　class="row m-3">
                    <div class="mb-3">
                        <label for="image" class="form-label">ファイルを選択してください</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">商品名を入力してください</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div>
                        <label for="body" class="form-label">商品の説明を入力してください</label>
                        <textarea name="body" id="body" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">商品の値段を入力してください</label>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                </div>
            </div>
            <input type="submit">
        </form>
    </div>
@endsection
