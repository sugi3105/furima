@extends('layouts.app')

@section('content')

<div class="item-list">
  @foreach($items as $item)
    <a href="/item/{{ $item->id }}" class="item-card">
      <img src="{{ $item->img_url }}">
      <p class="item-name">{{ $item->name }}</p>
      <p class="item-price">¥{{ number_format($item->price) }}</p>
    </a>
  @endforeach
</div>

@endsection

