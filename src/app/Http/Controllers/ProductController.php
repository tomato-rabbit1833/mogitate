<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');

        $query = Product::query();

        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $seasons = Season::all();
        return view('products.register', compact('seasons'));
    }

    // ✅ StoreProductRequestを使ったバージョンだけ残す
    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        $path = $request->file('image')->store('products', 'public');

        $product = Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image' => $path,
        ]);

        $product->seasons()->attach($validated['seasons']);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();
        $product->seasons()->sync($request->input('seasons'));

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }
    public function show($id)
{
    $product = Product::with('seasons')->findOrFail($id);
    return view('products.show', compact('product'));
}
    public function edit($id)
{
    $product = Product::with('seasons')->findOrFail($id);
    $seasons = Season::all();

    return view('products.edit', compact('product', 'seasons'));
}
public function destroy($id)
{
    $product = Product::findOrFail($id);

    // 画像の削除（存在していれば）
    if ($product->image && \Storage::exists('public/' . $product->image)) {
        \Storage::delete('public/' . $product->image);
    }

    // 関連する中間テーブルのデータ削除（season）
    $product->seasons()->detach();

    // 商品削除
    $product->delete();

    return redirect()->route('products.index')->with('success', '商品を削除しました');
}
}
