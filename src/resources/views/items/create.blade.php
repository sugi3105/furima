@extends('layouts.app')

@section('content')

<div class="sell-container">

 <h2>商品の出品</h2>

 <form action="/sell" method="POST"
       enctype="multipart/form-data" class="sell-form">
    @csrf
  
    <div class="form-group">
      <label>商品画像</label>

      <input type="file" name="img_url">
      @error('img_url')
       <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <h3>カテゴリー</h3>

      <div class="category-list">

        @foreach($categories as $category)

         <label class="category-tag">

          <input type="checkbox"
             name="categories[]"
             value="{{ $category->id }}"
             {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>

          <span>{{ $category->name }}</span>
         </label>
        @endforeach
      </div>
    </div>

    <div class="form-group">
      <label>商品の状態</label>

      <select name="condition">

        <option value="">選択してください</option>

        <option value="良好"
            {{ old('condition') == '良好' ? 'selected' : '' }}>良好</option>

        <option value="目立った傷や汚れなし"
            {{ old('condition') == '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし
        </option>

        <option value="やや傷や汚れあり"
             {{ old('condition') == 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり
        </option>

        <option value="状態が悪い"
              {{ old('condition') == '状態が悪い' ? 'selected' : '' }}>状態が悪い
        </option>

      </select>

      @error('condition')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label>商品名</label>

      <input type="text"
             name="name"
             value="{{ old('name') }}">

      @error('name')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label>ブランド名</label>

      <input type="text"
             name="brand"
             value="{{ old('brand') }}">

      @error('brand')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label>商品の説明</label>

      <textarea name="description">{{ old('description') }}</textarea>

      @error('description')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group">
      <label>販売価格</label>

      <input type="number"
             name="price"
             value="{{ old('price') }}">

      @error('price')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="sell-btn">
      出品する
    </button>

  </form>
</div>
@endsection