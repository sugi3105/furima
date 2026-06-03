@extends('layouts.app')

@section('content')

<div class="item-detail">

  <div class="item-image">
    <img src="{{ Str::startsWith($item->img_url, 'http') ? $item->img_url : asset('storage/' . $item->img_url) }}">
  </div>

  <div class="item-info">
    <h2>{{ $item->name }}</h2>
    <p class="brand-name">{{ $item->brand }}</p>
    <p>¥{{ number_format($item->price) }}</p>

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

      <div class="comment-icon">
        <img src="{{ asset('images/comment.png') }}">
        <p>{{ $item->comments->count() }}</p>   
      </div>

    <a href="/purchase/{{ $item->id }}" class="buy-btn">
       購入手続きへ
    </a>

    <h3>商品説明</h3>
    <p>{{ $item->description }}</p>

    <h3>商品情報</h3>

    <p>カテゴリー</p>

    <div class="category-list">

      @foreach($item->categories as $category)

     <span class="category-display">
      {{ $category->name }}
     </span>

      @endforeach
    </div>

    <p>商品の状態:{{ $item->condition }}</p>
    


    <h3>コメント({{ $item->comments->count() }})</h3>

    @foreach($item->comments as $comment)
      <p>{{ $comment->content }}</p>
    @endforeach

    <form method="POST" action="/item/{{ $item->id }}/comment">
      @csrf

    @error('content')
     <p>{{ $message }}</p>
    @enderror
    
      <textarea name="content"></textarea>
      <button>コメントする</button>
    </form>

  </div>

</div>
@endsection