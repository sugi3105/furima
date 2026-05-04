@extends('layouts.app')

@section('content')

<div class="item-detail">
  <img src="{{ $item->img_url }}">

  <div class="item-info">
    <h2>{{ $item->name }}</h2>
    <p>¥{{ number_format($item->price) }}</p>

    <button class="buy-btn">購入手続きへ</button>

    <h3>商品説明</h3>
    <p>{{ $item->description }}</p>

    <p>ブランド：{{ $item->brand }}</p>
    <p>状態：{{ $item->condition }}</p>
  </div>

</div>

@endsection