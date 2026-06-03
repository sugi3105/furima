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
          'img_url' => 'required|image',
          'condition' => 'required',
        ];
    }

    public function messages()
{
    return [
        'name.required' => '商品名は必須です',
        'price.required' => '価格は必須です',
        'img_url.url' => '正しいURLを入力してください',
    ];


}}
