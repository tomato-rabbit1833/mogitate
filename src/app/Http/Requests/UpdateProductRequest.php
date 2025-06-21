<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
{
    return [
        'name' => 'required',
        'price' => 'required|integer|min:0|max:10000',
        'seasons' => 'required|array',
        'description' => 'required|max:120',
        'image' => 'nullable|image|mimes:jpeg,png',
    ];
}

     public function messages(): array
    {
    return [
        'name.required' => '商品名を入力してください',
        'price.required' => '値段を入力してください',
        'price.integer' => '数値で入力してください',
        'price.min' => '0~10000円以内で入力してください',
        'price.max' => '0~10000円以内で入力してください',
        'seasons.required' => '季節を選択してください',
        'description.required' => '商品説明を入力してください',
        'description.max' => '120文字以内で入力してください',
        'image.image' => '画像ファイルを選択してください',
        'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
    ];
    }

}