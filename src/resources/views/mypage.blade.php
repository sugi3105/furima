@extends('layouts.app')

@section('content')
<div class="auth-box">
  <div class="box-content">

      <img src="{{ $user->profile_image }}">

      <h2>{{ $user->name }}</h2>

      <a href="/mypage/profile">
        プロフィールを編集
      </a>

      <h3>出品した商品</h3>

  @foreach($sellItems as $item)
     <div class="item-card">
       <img src="{{ $item->img_url }}">
       <p>{{ $item->name }}</p>
     </div>
  @endforeach

      <h3>購入した商品</h3>

  @foreach($purchasedItems as $item)
    <div class="item-card">
       <img src="{{ $item->img_url }}">
       <p>{{ $item->name }}</p>
    </div>
  @endforeach
      
  </div>
</div>
@endsection