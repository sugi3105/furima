@extends('layouts.app')

@section('content')
<div class="mypage">

   <div class="profile-header">

      <div class="profile-user">

         <img src="{{ asset('storage/'. $user->profile_image) }}">
         <h2>{{ $user->name }}</h2>
      </div>

      <a href="/mypage/profile" class="edit-btn">
         プロフィールを編集
      </a>
   </div>

   <div class="profile-tab">
      <a href="/mypage?page=sell">出品した商品</a>
      <a href="/mypage?page=buy">購入した商品</a>
   </div>

   <div class="item-list">

      @if(request('page') == 'buy')

      @foreach($purchasedItems as $item)
      <a href="/item/{{ $item->id }}" class="item-card">
         <img src="{{ Str::startsWith($item->img_url, 'http') ? $item->img_url : asset('storage/' . $item->img_url) }}">
         <p>{{ $item->name }}</p>
      </a>
      @endforeach

      @else

      @foreach($sellItems as $item)
      <a href="/item/{{ $item->id }}" class="item-card">
         <img src="{{ Str::startsWith($item->img_url, 'http') ? $item->img_url : asset('storage/' . $item->img_url) }}">
         <p>{{ $item->name }}</p>
      </a>
      @endforeach


      @endif

   </div>
</div>
@endsection