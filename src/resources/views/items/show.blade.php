@extends('layouts.app')

@section('content')

<div class="item-detail">

  <div class="item-image">
    <img src="{{ Str::startsWith($item->img_url, 'http') ? $item->img_url : asset('storage/' . $item->img_url) }}">
  </div>

  <div class="item-info">
    <h2>{{ $item->name }}</h2>
    <p class="brand-name">{{ $item->brand }}</p>
    <p class="price">
      ¥{{ number_format($item->price) }}
      <span>(税込)</span>
    </p>

    <div class="item-actions">
      @php
      $liked = $item->likes->where('user_id', auth()->id())->count();
      @endphp
      <div class="like-area">
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

      <div class="item-comment-icon">
        <img src="{{ asset('images/comment.png') }}">
        <p>{{ $item->comments->count() }}</p>
      </div>
    </div>

    <a href="/purchase/{{ $item->id }}" class="buy-btn">
      購入手続きへ
    </a>

    <h3>商品説明</h3>
    <p>{{ $item->description }}</p>

    <h3>商品情報</h3>
    <div class="category-row">
      <p>カテゴリー</p>

      <div class="category-list">

        @foreach($item->categories as $category)

        <span class="category-display">
          {{ $category->name }}
        </span>

        @endforeach
      </div>
    </div>

    <div class="item-condition">
      <span class="condition-title">商品の状態</span>
      <span class="condition-value">{{ $item->condition }}</span>
    </div>

    <h3>コメント({{ $item->comments->count() }})</h3>

    @foreach($item->comments as $comment)
    <div class="comment-user">
      <img
        src="{{ $comment->user->profile_image
            ? asset('storage/' . $comment->user->profile_image)
            : asset('images/default-user.png') }}"
        class="user-icon"
        alt="プロフィール画像">

      <span>{{ $comment->user->name }}</span>
    </div>

    <p class="comment-content">
      {{ $comment->content }}
    </p>
    @endforeach

    <form method="POST" action="/item/{{ $item->id }}/comment">
      @csrf

      @error('content')
      <p class="error">{{ $message }}</p>
      @enderror

      <textarea name=" content"></textarea>
      <button class="comment-btn">
        コメントを送信する
      </button>
    </form>

  </div>

</div>
@endsection