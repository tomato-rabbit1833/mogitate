@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品登録</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="name" class="form-label">商品名</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="商品名を入力" value="{{ old('name') }}">
        </div>

        {{-- 値段 --}}
        <div class="mb-3">
            <label for="price" class="form-label">値段</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="値段を入力" value="{{ old('price') }}">
        </div>

        {{-- 季節 --}}
        <div class="mb-3">
            <label class="form-label">季節（複数選択可）</label><br>
            @foreach ($seasons as $season)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" class="form-check-input"
                        {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $season->name }}</label>
                </div>
            @endforeach
        </div>

        {{-- 説明 --}}
        <div class="mb-3">
            <label for="description" class="form-label">商品説明</label>
            <textarea name="description" id="description" class="form-control" rows="4" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
        </div>

        {{-- 画像 --}}
        <div class="mb-3">
            <label for="image" class="form-label">商品画像（.png または .jpeg）</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        {{-- ボタン --}}
        <div class="d-flex justify-content-between">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-success">登録</button>
        </div>
    </form>
</div>
@endsection