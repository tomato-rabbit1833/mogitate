@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ $product->name }}</h2>

            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid" style="max-width: 300px;" alt="{{ $product->name }}">
            </div>

            <p><strong>値段：</strong> ¥{{ number_format($product->price) }}</p>

            <p>
                <strong>季節：</strong><br>
                @foreach ($product->seasons as $season)
                    <span class="badge bg-primary me-1">{{ $season->name }}</span>
                @endforeach
            </p>

            <p><strong>説明：</strong><br>{{ $product->description }}</p>

            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">商品を編集</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection