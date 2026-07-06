@extends('layouts.app')

@section('content')
<div class="auth-box">

 <div class="box-content">
    <h2 class="profile-title">プロフィール設定</h2>

    <form method="POST" action="/mypage/profile"
          enctype="multipart/form-data">
    @csrf

    <div class="profile-image">
        <div class="avatar"></div>
      
        <label for="profile_image" class="image-btn">
          画像を選択する
        </label>

        <input type="file"
               id="profile_image"
               name="profile_image" hidden>
    </div>

       <label>ユーザー名</label>
       <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}">
       @error('name')
        <div class="error">{{ $message }}</div>
       @enderror

       <label>郵便番号</label>
       <input type="text" name="postcode" value="{{ old('postcode', auth()->user()->postcode) }}">
       @error('postcode')
        <div class="error">{{ $message }}</div>
       @enderror

       <label>住所</label>
       <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}">
       @error('address')
        <div class="error">{{ $message }}</div>
       @enderror

       <label>建物名</label>
       <input type="text" name="building" value="{{ old('building', auth()->user()->building) }}">

       <button class="register-btn">更新する</button>
    </form>
  </div>
</div>

@endsection