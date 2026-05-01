@extends('layouts.app')

@section('content')

<div class="item-detail">
  <img src="{{ $item->img_url }}">

  <div class="item-info">
    <h2>{{ $item->name }}</h2>
    <p class="price">¥{{ number_format($item->price) }}</p>

    <p>{{ $item->description }}</p>
    <p>ブランド：{{ $item->brand }}</p>
    <p>状態：{{ $item->condition }}</p>
  </div>
</div>

@endsection