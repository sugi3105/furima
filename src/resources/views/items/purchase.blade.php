@extends('layouts.app')

@section('content')

<div class="purchase-container">

    <form action="/purchase/{{ $item->id }}" method="POST" class="purchase-form">
        @csrf

        <div class="purchase-left">

            <div class="purchase-item-info">
                <img src="{{ Str::startsWith($item->img_url, 'http')
                    ? $item->img_url
                    : asset('storage/' . $item->img_url) }}">

                <div class="item-text">
                    <h2>{{ $item->name }}</h2>
                    <p>¥{{ number_format($item->price) }}</p>
                </div>
            </div>

            <hr>

            <div class="payment-section">
                <h3>支払い方法</h3>

                <select name="payment" id="payment-select">
                    <option value="">選択してください</option>
                    <option value="konbini"
                        {{ old('payment') == 'konbini' ? 'selected' : '' }}>
                        コンビニ支払い
                    </option>
                    <option value="card"
                        {{ old('payment') == 'card' ? 'selected' : '' }}>
                        カード支払い
                    </option>
                </select>

                @error('payment')
                  <p class="error">{{ $message }}</p>
                @enderror

            </div>

            <hr>
            <div class="address-section">

              <div class="address-header">
                <h3>配送先</h3>

                <a href="/purchase/address/{{ $item->id }}">
                    変更する
                </a>
              </div>

               <p>〒{{ session('postcode', $user->postcode) }}</p>

               <p>{{ session('address', $user->address) }}</p>

               <p>{{ session('building', $user->building) }}</p>
             <hr>
              </div>
            </div>

            
        <div class="purchase-right">

            <div class="purchase-summary">

                <div class="summary-row">
                    <span>商品代金</span>
                    <span>¥{{ number_format($item->price) }}</span>
                </div>

                <div class="summary-row">
                    <span>支払い方法</span>
                    <span id="payment-display">選択してください</span>
                </div>

            </div>

            <button type="submit" class="purchase-btn">
                購入する
            </button>

        </div>

    </form>

</div>

<script>
const paymentSelect = document.getElementById('payment-select');
const paymentDisplay = document.getElementById('payment-display');

paymentSelect.addEventListener('change', function () {

    if (this.value === 'konbini') {
        paymentDisplay.textContent = 'コンビニ支払い';
    } else if (this.value === 'card') {
        paymentDisplay.textContent = 'カード支払い';
    } else {
        paymentDisplay.textContent = '選択してください';
    }

});
</script>

@endsection