@extends('layouts.app')

@section('content')

<div class="item-detail">

  <div class="item-image">
    <img src="{{ $item->img_url }}">
  </div>

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

<form method="POST" action="/item/{{ $item->id }}/like">
  @csrf
  <button>いいね</button>
</form>

<p>いいね数：{{ $item->likes->count() }}</p>

<h3>コメント</h3>

@foreach($item->comments as $comment)
  <p>{{ $comment->content }}</p>
@endforeach

<form method="POST" action="/item/{{ $item->id }}/comment">
  @csrf
  <textarea name="content"></textarea>
  <button>コメントする</button>
</form>

@endsection