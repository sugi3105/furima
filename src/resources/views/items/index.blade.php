@extends('layouts.app')

@section('content')

<div class="item-tabs">
  <a href="/" class="tab">おすすめ</a>
  <a href="/mylist" class="tab">マイリスト</a>
</div>

<div class="item-list">
  @foreach($items as $item)
    <a href="/item/{{ $item->id }}" class="item-card">
      <div class="item-image-wrapper">

       <img src="{{ $item->img_url }}">

       @if($item->is_sold)
        <p class="sold">Sold</p>
       @endif
      </div>

      <p class="item-name">{{ $item->name }}</p>
      <p class="item-price">¥{{ number_format($item->price) }}</p>
    </a>
  @endforeach
</div>

@endsection

