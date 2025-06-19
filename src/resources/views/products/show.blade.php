@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>

    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mb-3" style="max-width: 300px;" alt="{{ $product->name }}">

    <p><strong>値段：</strong> ¥{{ number_format($product->price) }}</p>

    <p><strong>季節：</strong> 
        @foreach ($product->seasons as $season)
            <span class="badge bg-primary">{{ $season->name }}</span>
        @endforeach
    </p>

    <p><strong>説明：</strong><br>{{ $product->description }}</p>

    <a href="{{ route('products.index') }}" class="btn btn-secondary">一覧に戻る</a>
</div>
@endsection