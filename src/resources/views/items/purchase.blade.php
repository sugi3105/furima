@extends('layouts.app')

@section('content')

<div class="purchase-left">

 <div class="purchase-item-info">
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

        @if($item->shipping_address)
          <p> {{ $item->shipping_address }}</p>
        @else
          <p> {{ session('address', $user->address) }}</p>
        @endif      

        <a href="/purchase/address/{{ $item->id }}">
            変更する
        </a>
    </div>
    
    <div class="purchase-right">

    <div class="purchase-summary">
        <p>商品代金</p>
        <p>¥{{ number_format($item->price) }}</p>
    </div>

    <div class="purchase-summary">
        <p>カード支払い</p>
    </div>
    
    <form action="/purchase/{{ $item->id }}" method="POST">
        @csrf

      <button>購入する</button>
    </form>
  </div>
</div>
    <script>
      const select = document.getElementById('payment-select');
      const payment = document.getElementById('payment-method');

      select.addEventListener('change', function () {
       payment.textContent = select.value;
});
    </script>

@endsection


