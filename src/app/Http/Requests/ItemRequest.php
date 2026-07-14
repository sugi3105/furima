<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name' => 'required|max:255',
          'price' => 'required|integer|min:0',
          'description' => 'required',
          'img_url' => 'required|image|mimes:jpeg,png',
          'condition' => 'required',
          'categories' => 'required|array',
        ];
    }

    public function messages()
{
    return [
        'name.required' => '商品名は必須です',
        'price.required' => '価格は必須です',
        'img_url.required' => '商品画像を選択してください',
        'img_url.image' => '画像ファイルを選択してください',
        'categories.required' => 'カテゴリーを選択してください',
        'condition.required' => '商品の状態を選択してください',
        'description.required' => '商品の説明を入力してください',
    ];


}}
