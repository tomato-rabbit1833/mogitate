@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品一覧</h1>

    {{-- 検索・並び替えフォーム --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="{{ route('products.search') }}" method="GET" class="input-group">
                <input type="text" name="keyword" class="form-control" placeholder="商品名を検索" value="{{ request('keyword') }}">
                <button type="submit" class="btn btn-outline-secondary">検索</button>
            </form>
        </div>
        <div class="col-md-6">
            <form action="{{ route('products.search') }}" method="GET" class="d-flex justify-content-end">
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <div class="input-group w-auto">
                    <label class="input-group-text" for="sort">並び替え</label>
                    <select name="sort" id="sort" class="form-select" onchange="this.form.submit()">
                        <option value="">選択してください</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が低い順</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                    </select>
                </div>
            </form>
        </div>
    </div>

    @if(request('sort'))
        <div class="mb-3">
            <span class="badge bg-secondary">
                並び替え：{{ request('sort') === 'price_asc' ? '価格が低い順' : '価格が高い順' }}
                <a href="{{ route('products.search', ['keyword' => request('keyword')]) }}" class="text-white text-decoration-none ms-2">&times;</a>
            </span>
        </div>
    @endif

    {{-- 登録ボタン --}}
    <div class="mb-3 text-end">
        <a href="{{ route('products.register') }}" class="btn btn-primary">+ 商品を追加</a>
    </div>

    {{-- 商品カード一覧 --}}
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $product->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">¥{{ number_format($product->price) }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary w-100 mb-2">詳細を見る</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除してもよろしいですか？');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ページネーション --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection