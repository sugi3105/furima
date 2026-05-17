@extends('layouts.app')

@section('content')

<div class="purchase-left">

 <div class="parchase-item-info">
    <img src="{{ $item->img_url }}">

     <div>
       <h2>
        {{ $item->name }}</h2>
        <p>¥{{ number_format($item->price) }}</p>
     </div>
     
  </div>

    <hr>
    <div class="payment">
        <h3>支払い方法</h3>

        <select name="payment">
            <option>コンビニ支払い</option>
            <option>カード支払い</option>
        </select>
    </div>

    <hr>

    <div class="address">
        <h3>配送先</h3>

        <p>{{ $user->address }}</p>
    </div>
    
    <div class="puchase-right">

    <div class="puchase-summary">
        <p>商品代金</p>
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <div class="puchase-summary">
        <option>コンビニ支払い</option>
        <option>カード支払い</option>
    </div>
    
    <form action="/purchase/{{ $item->id }}" method="POST">
        @csrf

    <button>購入する</button>
  </div>
</div>

@endsection


