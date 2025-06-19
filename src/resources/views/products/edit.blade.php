@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品編集</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name">商品名</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}">
        </div>

        <div class="mb-3">
            <label for="price">値段</label>
            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label for="seasons">季節（複数選択可）</label><br>
            @foreach ($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label><br>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="description">商品説明</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image">商品画像（新しくアップロードした場合は上書きされます）</label><br>
            <img src="{{ asset('storage/' . $product->image) }}" style="max-width: 150px;" class="mb-2">
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
    </form>
</div>
@endsection