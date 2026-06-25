@extends('layouts.app')

@section('content')

<div class="purchase-left">

 <div class="purchase-item-info">
    
    <img src="{{ Str::startsWith($item->img_url, 'http') ? $item->img_url : asset('storage/' . $item->img_url) }}">
     <div>
       <h2>
        {{ $item->name }}</h2>
    <div class="payment">
        <h3>支払い方法</h3>

        <select name="payment">
            <option>コンビニ支払い</option>
            <option>カード支払い</option>
        </select>
    </div>

    <hr>
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <div class="purchase-summary">
        <p>カード支払い</p>
    </div>

    <form action="/purchase/{{ $item->id }}" method="POST">
        @csrf

        <select name="payment">
            <option value="konbini">コンビニ支払い</option>
            <option value="card">カード支払い</option>
        </select>

      <button>購入する</button>
    </form>
  </div>

@endsection