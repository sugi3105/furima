@extends('layouts.app')

@section('content')
<div class="auth-box">
  <div class="box-content">

      <img src="{{ $user->profile_image }}">

      <h2>{{ $user->name }}</h2>

      <h3>出品した商品</h3>

  @foreach($sellItems as $item)
     <p>{{ $item->name }}</p>
  @endforeach

      <h3>購入した商品</h3>

  @foreach($purchasedItems as $item)
    <p>{{ $item->name }}</p>
  @endforeach
      
  </div>
</div>
@endsection