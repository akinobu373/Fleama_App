@extends('layouts.main')
@section('title', '新規登録')
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
<div class="col-8 col-offset-2 mx-auto">
    <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
        <div class="card mb-3">
            @csrf
            <div class="row m-3">
                <div class="mb-3">
                    <label for="file" class="form-label">ファイルを選択してください</label>
                    <input type="file" name="file[]" id="file" class="form-control" value="{{ old('file') }}" multiple="multiple">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">商品名を入力してください</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">商品の値段（数字のみ）を入力してください</label>
                    <div class="d-flex flex-row">
                        <div class="mr-2 col-11"><input type="number" name="price" id="price" class="form-control "
                                min='0' value="{{ old('price') }}"></div>
                        <div class="col-1 h1">円</div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">商品の説明を入力してください</label>
                    <textarea name="body" id="body" rows="10" class="form-control" value="{{ old('body') }}"></textarea>
                </div>
            </div>
        </div>
        <input type="submit">
    </form>
</div>
@endsection
