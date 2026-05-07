@extends('layouts.app')

@section('content')

<div class="item-detail">

  <div class="item-image">
    <img src="{{ $item->img_url }}">
  </div>

  <div class="item-info">
    <h2>{{ $item->name }}</h2>
    <p>¥{{ number_format($item->price) }}</p>

    <div class="item-actions">
      @php
        $liked = $item->likes->where('user_id', auth()->id())->count();
      @endphp

      <form method="POST" action="/item/{{ $item->id }}/like">
        @csrf
        <button type="submit" style="background:none; border:none;">
          @if($liked)
          <img src="{{ asset('images/heart_active.png') }}">
          @else
          <img src="{{ asset('images/heart_default.png') }}">
          @endif
        </button>
      </form>

      <p>{{ $item->likes->count() }}</p>
    </div>

    <button class="buy-btn">購入手続きへ</button>

    <h3>商品説明</h3>
    <p>{{ $item->description }}</p>

    <h3>コメント</h3>

    @foreach($item->comments as $comment)
      <p>{{ $comment->content }}</p>
    @endforeach

    <form method="POST" action="/item/{{ $item->id }}/comment">
      @csrf
      <textarea name="content"></textarea>
      <button>コメントする</button>
    </form>

  </div>

</div>