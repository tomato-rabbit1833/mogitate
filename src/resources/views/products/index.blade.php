@extends('layouts.app')

@section('content')
<div class="container">
    <h1>商品一覧</h1>

 

    <form action="{{ route('products.search') }}" method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="商品名を検索" value="{{ request('keyword') }}">
        <button type="submit" class="btn btn-outline-secondary">検索</button>
      </div>
   </form>

   {{-- 並び替え選択フォーム --}}
<form action="{{ route('products.search') }}" method="GET" class="mb-4">
    <input type="hidden" name="keyword" value="{{ request('keyword') }}">

    <label for="sort">並び替え:</label>
    <select name="sort" id="sort" onchange="this.form.submit()" class="form-select w-auto d-inline ms-2">
        <option value="">選択してください</option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が低い順</option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
    </select>
</form>
@if(request('sort'))
    <div class="mb-3">
        <span class="badge bg-secondary">
            並び替え：{{ request('sort') === 'price_asc' ? '価格が低い順' : '価格が高い順' }}
            <a href="{{ route('products.search', ['keyword' => request('keyword')]) }}" class="text-white text-decoration-none ms-2">&times;</a>
        </span>
    </div>
@endif

    <a href="{{ route('products.register') }}" class="btn btn-primary mb-3">+ 商品を追加</a>
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">¥{{ number_format($product->price) }}</p>
                    <a href="{{ url('/products/' . $product->id) }}" class="btn btn-outline-primary">詳細を見る</a>

                      <!-- 削除ボタン -->
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('本当に削除してもよろしいですか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline-danger mt-2">削除</button>
    </form>
</div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }} {{-- ページネーション --}}
    </div>
</div>
@endsection