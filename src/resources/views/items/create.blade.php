@extends('layouts.app')

@section('content')

@if ($errors->any())

  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>

@endif

<form action="/sell" method="POST" class="form">
  @csrf

  <input type="text" name="name" placeholder="商品名">
  <input type="number" name="price" placeholder="価格">
  <input type="text" name="brand" placeholder="ブランド">
  <textarea name="description" placeholder="説明"></textarea>
  <input type="text" name="img_url" placeholder="画像URL">
  <input type="text" name="condition" placeholder="状態">

  <h3>カテゴリー</h3>

  <div class="category-list">

   @foreach($categories as $category)

    <label class="category-tag">

    <input type="checkbox"
           name="categories[]"
           value="{{ $category->id }}">
    <span>{{ $category->name }}</span>
    </label>
   @endforeach
  </div>
  <button type="submit">出品</button>
</form>
  


@endsection